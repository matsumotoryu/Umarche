@props(['status' => 'info'])

@php
if($status === 'info'){$bgColor = 'bg-blue-300';}
if($status === 'error'){$bgColor = 'bg-red-500';}
@endphp

@if(session('message'))
 <div class="{{$bgColor}} w-1/2 mx-auto p2 text-white">
   {{session('message')}}
   {{-- messageはOwnersControllerの->with('message','オーナ登録を完了しました。');の部分  --}}
</div>
@endif
