<div>
    @for ($i = 0; $i < count($games_list); $i++)
        <livewire:get-data-match :singleMatch="$games_list[$i]" :continent="$continent" :puuid="$profile_data->puuid"
            :companionJSON="$companion_json" :queueJSON="$queues_json" />
    @endfor
</div>
