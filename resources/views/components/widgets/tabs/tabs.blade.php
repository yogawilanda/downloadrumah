{{-- ----------- Yoga Wilanda Documentation v1.0.0 -----------------
<meta_config>
0. author________________: yogawilanda <eaywilanda@gmail.com>
1. path__________________: resources/views/components/widgets/tabs/tabs.blade.php
2. usage_________________: Application-wide UI / Design System
3. type__________________: Blade UI Component
4. expected_data_________: [items]
5. purpose_______________: Render a collection of selectable tabs.
6. ruling________________: Tab presentation is delegated to the Tab primitive.
7. ruling_structure______: Tabs → Tab → Consumer
8. status_______________: Active
</meta_config>
------------------------------------------------------------------ --}}

@props(['items'])

<div class="grid grid-cols-2 border border-slate-300">
    @foreach ($items as $item)
        <x-widgets.tabs.tab
            :active="$item['active'] ?? false"
            :action="$item['action'] ?? null"
            :label="$item['label']"
            :value="$item['value'] ?? null"
            :class="$loop->first ? '' : 'border-l border-slate-300'"
        />
    @endforeach
</div>

