<!-- Ô tìm nhanh khách hàng ở trang danh sách phiếu (tasks/listTask). Dữ liệu: customers/quickSearch -->
<div class="customer-quick-search">
    <label for="customerQuickSearch">Tìm kiếm Khách hàng:</label>
    <div class="customer-quick-search-box">
        <input id="customerQuickSearch" type="text" class="form-control" placeholder="Nhập tên hoặc số điện thoại..." autocomplete="off">
        <div id="customerQuickSearchResults" class="customer-quick-search-results" style="display:none;"></div>
    </div>
</div>
<script>
(function () {
    var input = document.getElementById('customerQuickSearch');
    var box = document.getElementById('customerQuickSearchResults');
    var url = '<?php echo base_url('customers/quickSearch'); ?>';
    var timer = null, lastQuery = '', request = null;

    function el(tag, className, text) {
        var e = document.createElement(tag);
        if (className) e.className = className;
        if (text !== undefined) e.textContent = text;
        return e;
    }

    function show(customers, query) {
        box.innerHTML = '';
        if (!customers.length) {
            box.appendChild(el('div', 'cqs-empty', 'Không tìm thấy khách hàng "' + query + '"'));
        }
        customers.forEach(function (c) {
            var row = el('div', 'cqs-row');
            var info = el('div', 'cqs-info');
            info.appendChild(el('b', '', c.name));
            info.appendChild(el('span', 'cqs-phone', ' - ' + c.phone));
            info.appendChild(el('span', 'cqs-count', ' (' + c.tasks + ' máy)'));
            var actions = el('div', 'cqs-actions');
            var history = el('a', '', 'Lịch sử'); history.href = c.historyUrl; history.target = '_blank';
            var add = el('a', '', '+ Thêm máy sửa'); add.href = c.addTaskUrl; add.target = '_blank';
            actions.appendChild(history);
            actions.appendChild(el('span', 'cqs-sep', '|'));
            actions.appendChild(add);
            row.appendChild(info);
            row.appendChild(actions);
            box.appendChild(row);
        });
        box.style.display = 'block';
    }

    function search() {
        var q = input.value.trim();
        if (q.length < 2) { box.style.display = 'none'; lastQuery = ''; return; }
        if (q === lastQuery) { box.style.display = 'block'; return; }
        lastQuery = q;
        if (request) request.abort();
        request = new XMLHttpRequest();
        request.open('GET', url + '?keyword=' + encodeURIComponent(q));
        request.onload = function () {
            if (request.status !== 200 || q !== input.value.trim()) return;
            try { show(JSON.parse(request.responseText), q); } catch (e) { box.style.display = 'none'; }
        };
        request.send();
    }

    input.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(search, 300);
    });
    input.addEventListener('focus', function () {
        if (input.value.trim().length >= 2 && box.innerHTML !== '') box.style.display = 'block';
    });
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') box.style.display = 'none';
    });
    document.addEventListener('click', function (e) {
        if (!e.target.closest || !e.target.closest('.customer-quick-search-box')) box.style.display = 'none';
    });
})();
</script>
