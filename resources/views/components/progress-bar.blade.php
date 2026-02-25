@props(['percentage' => 0])

<div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
    <div class="bg-teal-600 h-2.5 rounded-full transition-all duration-1000"
         style="width: {{ $percentage }}%"></div>
</div>
<div class="flex justify-between items-center">
    <span class="text-xs font-medium text-teal-700">{{ $percentage }}% funded</span>
</div>
