<div class="col-lg-6 mb-5 text-center">
    <span class="col-12 col-md-3">ترتيب بحسب:</span>
    <a href="?sortBy=title{{ isset($order) ? '&order='.$order : '' }}" class="btn {{ isset($sortBy) ? ($sortBy == 'title' ? 'btn-default' : 'btn-secondary') : '' }}">الأبجدية A-Z</a>
    <a href="?sortBy=score{{ isset($order) ? '&order='.$order : '' }}" class="btn {{ isset($sortBy) ? ($sortBy == 'score' ? 'btn-default' : 'btn-secondary') : '' }}">التقييم</a>
    <a href="?sortBy=date{{ isset($order) ? '&order='.$order : '' }}" class="btn {{ isset($sortBy) ? ($sortBy == 'date' ? 'btn-default' : 'btn-secondary') : '' }}">تاريخ النشر</a>
</div>
<div class="col-lg-6 mb-5 text-center">
    <span>نوع الترتيب:</span>
    <a href="{{ isset($sortBy) ? '?sortBy='.$sortBy.'&' : '?' }}order=DESC" class="btn {{ isset($order) ? ($order == 'ASC' ? 'btn-secondary' : 'btn-default') : '' }}">تنازلي</a>
    <a href="{{ isset($sortBy) ? '?sortBy='.$sortBy.'&' : '?' }}order=ASC" class="btn {{ isset($order) ? ($order == 'ASC' ? 'btn-default' : 'btn-secondary') : '' }}">تصاعدي</a>
</div>