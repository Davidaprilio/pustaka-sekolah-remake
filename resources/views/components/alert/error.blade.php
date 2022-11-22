@props([
    'dismiss' => true,
    'name',
])

@error($name)
    <x-alert.basic type="danger" :dismiss="$dismiss" :message="$message" />
@enderror
