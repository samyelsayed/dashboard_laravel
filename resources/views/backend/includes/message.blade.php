
    <div class="col-12">
         @if (session()->has('success'))            {{--//هنا بتشيك لو السيشن موجودة علشان اعرف اليوزر العمليه تمت بنجاح ولا لا --}}
            <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
        @endif
    </div>
