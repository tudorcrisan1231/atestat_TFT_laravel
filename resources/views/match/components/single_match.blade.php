<div>
    @for ($i = 0; $i < count($games_list); $i++)
        <livewire:get-data-match :singleMatch="$games_list[$i]" :continent="$continent" />
    @endfor
</div>
