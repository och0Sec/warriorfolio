@if($module->newsletter)
<x-core.layout>
    <div class="mx-auto max-w-7xl px-4">
        <div
            class="flex flex-wrap items-center justify-center rounded-lg border border-secondary-500 border-opacity-30 bg-secondary-100 px-4 py-8 text-center dark:bg-secondary-950 lg:py-12">
            <div class="image w-full px-4 lg:w-1/4">
                <img class="mx-auto max-h-24 md:max-h-48 lg:max-h-60"
                    src="{{ $info->newsletter_section_image ? asset('storage/' . $info->newsletter_section_image) : asset('img/core/svg/developer.svg') }}"
                    alt="newsletter-image" />
            </div>
            <div class="text w-full p-4 lg:w-2/4">
                <span class="text-2xl font-semibold leading-tight tracking-tighter md:text-4xl lg:text-5xl">
                    <p>
                        {!! $info->newsletter_section_title !!}
                    </p>
                    <p class="text-xs font-normal tracking-normal md:text-sm">
                        {!! $info->newsletter_section_subtitle_text !!}
                    </p>
                </span>
            </div>
            <div class="form mx-auto flex w-full flex-wrap justify-center p-4 lg:w-1/4">
                <livewire:newsletter :buttonText='$info->newsletter_section_button_text'>
            </div>
        </div>
    </div>
</x-core.layout>
@endif
