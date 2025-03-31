<button {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded-md px-4 py-2 font-semibold  uppercase  transition ease-in-out duration-150 px-6 transition-all duration-150 ease-linear  shadow outline-none bg-[#c9ba46] hover:bg-[#a0852e] text-[#f9f9ed] hover:shadow-sm focus:outline-none']) }}>
    {{ $slot }}
</button>
