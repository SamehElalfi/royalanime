@extends('layouts.app')

@section('style')
.text-bold{
    font-weight:bold;
}
@endsection

@section('content')
    <!-- Latest Anime -->
    <section class="section section-components profile-page" id="section-components">
        <div class="container">
            <!-- Section Title -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-12">
                    <h1>
                        <span>البحث</span>
                    </h1>
                </div>
            </div>
            <div class="ml-4 pl-1">أبحث عن أي حلقة أو مسلسل أو فيلم و بأي لغة تريد</div>
            
            <script async src="https://cse.google.com/cse.js?cx=005544390205962353752:g3qnizsiiv5"></script>
            <div class="gcse-search"></div>
            
            <div class="ml-4 pl-1 text-bold">إن لم تجد ما تبحث عنه أو واجهتك مشكلة أثناء البحث، قم <a href="/contact">بالتواصل معنا من هنا</a></div>
        </div>
    </section>
@endsection