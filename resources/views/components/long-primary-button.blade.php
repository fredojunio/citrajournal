<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full py-2 bg-citradark-500 border border-transparent rounded-md font-bold text-white hover:bg-citradark-700 focus:bg-citradark-400 active:bg-citradark-600 focus:outline-none focus:ring-2 focus:ring-citradark-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
