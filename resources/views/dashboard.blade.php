<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="stats shadow bg-white">
  <div class="stat">
    <div class="stat-figure text-primary">
      <span class="material-icons-outlined">category</span>
    </div>
    <div class="stat-title text-gray-700">Creator Application</div>
    <div class="stat-value text-gray-700">{{$applicationTotal}}</div>
    <div class="stat-desc text-gray-700">↗︎ {{$applicationTotalToday}} Application Today</div>
  </div>

  <div class="stat">
    <div class="stat-figure text-primary">
     <span class="material-icons-outlined">web_asset</span>
    </div>
    <div class="stat-title text-gray-700">Asset Total</div>
    <div class="stat-value text-gray-700">{{$assetTotalActive}}</div>
    <div class="stat-desc text-gray-700">↗︎ {{$assetToday}} Assets Today</div>
  </div>

  <div class="stat">
    <div class="stat-figure text-primary">
        <span class="material-icons-outlined">account_circle</span>
    </div>
    <div class="stat-title text-gray-700">User Total</div>
    <div class="stat-value text-gray-700">{{$userTotal}}</div>
    <div class="stat-desc text-gray-700">↗︎ {{$userTodayRegister}} Register Today</div>
  </div>
</div>
</x-app-layout>
