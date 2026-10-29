# Yes Mobile API v1

API chỉ đọc, dùng để tra cứu khách hàng, phiếu sửa chữa và thông tin bảo hành.

- Base URL: `https://yesmobile.vn/api/v1`
- Chỉ hỗ trợ `GET`. Dữ liệu trả về dạng JSON, mã hoá UTF-8.
- Giới hạn: 60 request/phút cho mỗi key (xem header `X-RateLimit-Remaining`).

## Xác thực

Mỗi đối tác được cấp 1 API key. Gửi key trong header của mọi request:

```
X-API-Key: <api-key>
```

Hoặc `Authorization: Bearer <api-key>`. Không gửi key trên URL.

```bash
curl -H "X-API-Key: <api-key>" "https://yesmobile.vn/api/v1/warranty?phone=0988071819"
```

## Định dạng phản hồi

Thành công:

```json
{ "success": true, "data": { ... }, "meta": { "page": 1, "per_page": 20, "total": 76, "total_pages": 4 } }
```

`meta` chỉ có ở các endpoint trả về danh sách. Phân trang bằng `?page=` (từ 1) và `?per_page=` (1-100, mặc định 20).

Lỗi:

```json
{ "success": false, "error": { "code": "invalid_api_key", "message": "..." } }
```

| HTTP | code | Ý nghĩa |
|------|------|---------|
| 400 | `invalid_parameter` | Tham số sai định dạng |
| 401 | `missing_api_key`, `invalid_api_key` | Thiếu key, key sai hoặc đã bị thu hồi |
| 403 | `ip_not_allowed` | Key bị giới hạn IP và IP gọi không nằm trong danh sách |
| 404 | `not_found` | Không có dữ liệu hoặc endpoint không tồn tại |
| 405 | `method_not_allowed` | Không phải GET |
| 429 | `rate_limited` | Vượt giới hạn; chờ theo header `Retry-After` (giây) |

Thời gian có dạng `YYYY-MM-DD HH:MM:SS`, giá trị `null` nếu chưa có.

## Endpoints

### Tra cứu bảo hành

`GET /warranty?phone={sđt}` hoặc `?imei={imei}` hoặc `?code={mã phiếu}` (gửi đúng 1 tham số).

```json
{
  "success": true,
  "data": {
    "found": true,
    "customer": { "name": "Chị Hương", "phone": "0988071819" },
    "items": [{
      "task_id": 16, "code": "YMS0000016",
      "type": 1, "type_label": "Sửa phần cứng",
      "device": "Samsung S7102", "imei": "090695",
      "issue": "Thay cảm ứng, vỏ",
      "received_at": "2017-06-04 09:59:01",
      "status": "closed",
      "warranty_days": 30,
      "warranty_until": "2017-07-06 19:00:21",
      "in_warranty": false
    }]
  }
}
```

`warranty_until` chỉ có khi khách đã nhận máy (`status = closed`). `in_warranty` là `true` khi hôm nay chưa quá `warranty_until`.

### Khách hàng

| Endpoint | Mô tả |
|----------|-------|
| `GET /customers` | Danh sách. Lọc: `q` (tên hoặc SĐT chứa chuỗi), `phone` (SĐT chính xác) |
| `GET /customers/{id}` | Chi tiết 1 khách hàng |
| `GET /customers/{id}/tasks` | Các phiếu của khách hàng (có phân trang) |

```json
{ "id": 7, "name": "Chị Hương", "phone": "0988071819", "shop": 1, "created_at": null, "updated_at": null }
```

### Phiếu sửa chữa

| Endpoint | Mô tả |
|----------|-------|
| `GET /tasks` | Danh sách phiếu, mới nhất trước |
| `GET /tasks/{id}` | Chi tiết phiếu |
| `GET /tasks/code/{code}` | Chi tiết phiếu theo mã, VD `YMS0000009` |
| `GET /tasks/{id}/histories` | Lịch sử thay đổi của phiếu |

Bộ lọc của `GET /tasks`:

| Tham số | Giá trị |
|---------|---------|
| `customer_id` | id khách hàng |
| `status` | `open` (chưa trả máy) hoặc `closed` (khách đã nhận máy) |
| `type` | `1` sửa phần cứng, `2` sửa lấy ngay, `3` sửa phần mềm, `4` bán phụ kiện |
| `shop` | `1` cửa hàng Trương Công Định, `2` cửa hàng Long Sơn |
| `imei`, `code` | so khớp chính xác |
| `created_from`, `created_to` | `YYYY-MM-DD` hoặc `YYYY-MM-DD HH:MM:SS` |
| `updated_since` | lấy phiếu thay đổi từ thời điểm này, dùng để đồng bộ định kỳ |

Một phiếu:

```json
{
  "id": 9, "code": "YMS0000009", "customer_id": 1,
  "type": 1, "type_label": "Sửa phần cứng",
  "category": 0, "category_label": "Điện thoại",
  "device": { "name": "S7 Edge", "imei": "12345", "accessories": "Sim Vina", "features": null },
  "issue": "Vỡ màn hình",
  "price": "500000",
  "parts_ordered": 0, "parts_ordered_label": "Không",
  "technical_status": 1, "technical_status_label": "Đã sửa xong",
  "customer_notified": true, "customer_notified_at": "2017-06-03 10:00:00",
  "appointment_at": "2017-05-07 17:00:00",
  "status": "closed", "closed_at": "2017-06-04 11:16:43",
  "warranty_days": 90, "warranty_until": "2017-09-02 11:16:43",
  "shop": 1,
  "created_at": "2017-05-07 14:59:17", "updated_at": "2017-06-04 11:16:43"
}
```

- `price` là chuỗi, thường là số tiền (VNĐ) nhưng có thể là chữ, VD `"Bảo hành"`.
- `category`: `0` điện thoại, `1` laptop, `2` mua xác.
- `parts_ordered`: `0` không, `1` có, `2` đã đặt hàng.
- `technical_status`: `0` chưa sửa xong, `1` đã sửa xong, `2` không sửa được, `3` tư vấn không sửa, `4` không có linh kiện, `5` khách đổi ý, không sửa.
- `appointment_at`: thời gian hẹn khách lấy máy.

Lịch sử phiếu:

```json
[{ "id": 3, "task_id": 3906, "changes": { "taskStatus": { "from": "0", "to": "1" }, "timeWarranty": { "from": "0", "to": "60" } }, "created_at": "2019-12-16 10:15:15" }]
```
