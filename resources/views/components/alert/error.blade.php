@props([
    'dismiss' => true,
    'name',
])

@error($name)
    <x-alert.basic :type="$type" :dismiss="$dismiss" :message="$message" :id="$type" />
@enderror
