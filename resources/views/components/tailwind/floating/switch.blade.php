
@props([
    'name',
    'label',
    'id' => null,
    'value' => '',
])
<label class="inline-flex items-center cursor-pointer">
    <input type="checkbox" name="{{ $name }}" value="1" class="sr-only peer" {{ old($name, $value) == '1' ? 'checked' : '' }}>
    <div class="relative w-[2.3rem] h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label }}</span>
</label>
