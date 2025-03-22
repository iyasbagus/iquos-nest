<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="stats shadow">
  <div class="stat">
    <div class="stat-figure text-primary">
      <span class="material-icons-outlined">category</span>
    </div>
    <div class="stat-title">Category Total</div>
    <div class="stat-value">{{$categoryTotal}}</div>
    <div class="stat-desc">Jan 1st - Feb 1st</div>
  </div>

  <div class="stat">
    <div class="stat-figure text-primary">
     <span class="material-icons-outlined">web_asset</span>
    </div>
    <div class="stat-title">Asset Total</div>
    <div class="stat-value">{{$assetTotalActive}}</div>
    <div class="stat-desc">↗︎ {{$assetToday}} Assets Today</div>
  </div>

  <div class="stat">
    <div class="stat-figure text-primary">
        <span class="material-icons-outlined">account_circle</span>
    </div>
    <div class="stat-title">User Total</div>
    <div class="stat-value">{{$userTotal}}</div>
    <div class="stat-desc">↗︎ {{$userTodayRegister}} Register Today</div>
  </div>
</div>
</x-app-layout>
