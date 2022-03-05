<div>
    @for ($i = 0; $i < count($games_list); $i++)
        <livewire:get-data-match :singleMatch="$games_list[$i]" :continent="$continent" :puuid="$profile_data->puuid"
            :region="$region" :companionJSON="$companion_json" :queueJSON="$queues_json"
            :augments_itemsJSON="$augments_itemsJSON" />
    @endfor
</div>
