 {{-- STATE 1: Skeleton Loader saat Livewire memproses/fetch data
 resources/views/components/layouts/home/search-in-progress.blade.php
 --}}
 <div wire:loading wire:target="search, selectCitySuggestion" class="w-full p-3 space-y-3">
     <div class="space-y-2">
         <div class="h-2.5 w-20 bg-gray-200 rounded animate-pulse"></div>
         <div class="h-8 w-full bg-gray-100 rounded-md animate-pulse"></div>
         <div class="h-8 w-full bg-gray-100 rounded-md animate-pulse"></div>
     </div>
     <div class="space-y-2 pt-2 border-t border-gray-100">
         <div class="h-2.5 w-24 bg-gray-200 rounded animate-pulse"></div>
         <div class="flex items-center gap-2">
             <div class="h-9 w-9 bg-gray-200 rounded-md animate-pulse shrink-0"></div>
             <div class="space-y-1.5 flex-1">
                 <div class="h-3 w-3/4 bg-gray-100 rounded animate-pulse"></div>
                 <div class="h-2.5 w-1/4 bg-gray-100 rounded animate-pulse"></div>
             </div>
         </div>
     </div>
 </div>
