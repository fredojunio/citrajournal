<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style type="text/css">
        /*! tailwindcss v3.2.7 | MIT License | https://tailwindcss.com*/
        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e5e7eb
        }

        :after,
        :before {
            --tw-content: ""
        }

        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            -o-tab-size: 4;
            tab-size: 4;
            font-family: Roboto, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            font-feature-settings: normal
        }

        body {
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: initial
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: initial;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: initial
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0
        }

        fieldset,
        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            opacity: 1;
            color: #9ca3af
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        ::-webkit-datetime-edit,
        ::-webkit-datetime-edit-day-field,
        ::-webkit-datetime-edit-hour-field,
        ::-webkit-datetime-edit-meridiem-field,
        ::-webkit-datetime-edit-millisecond-field,
        ::-webkit-datetime-edit-minute-field,
        ::-webkit-datetime-edit-month-field,
        ::-webkit-datetime-edit-second-field,
        ::-webkit-datetime-edit-year-field {
            padding-top: 0;
            padding-bottom: 0
        }

        select {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3E%3C/svg%3E");
            background-position: right .5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact
        }

        [type=checkbox]:checked,
        [type=radio]:checked {
            background-size: 100% 100%;
            background-position: 50%;
            background-repeat: no-repeat
        }

        [type=checkbox]:checked,
        [type=checkbox]:checked:focus,
        [type=checkbox]:checked:hover,
        [type=radio]:checked,
        [type=radio]:checked:focus,
        [type=radio]:checked:hover {
            border-color: #0000;
            background-color: currentColor
        }

        [type=file]:focus {
            outline: 1px solid ButtonText;
            outline: 1px auto -webkit-focus-ring-color
        }

        [multiple],
        [type=date],
        [type=datetime-local],
        [type=email],
        [type=month],
        [type=number],
        [type=password],
        [type=search],
        [type=tel],
        [type=text],
        [type=time],
        [type=url],
        [type=week],
        select,
        textarea {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: #fff;
            border-color: #6b7280;
            border-width: 1px;
            border-radius: 0;
            padding: .5rem .75rem;
            font-size: 1rem;
            line-height: 1.5rem;
            --tw-shadow: 0 0 #0000
        }

        [multiple]:focus,
        [type=date]:focus,
        [type=datetime-local]:focus,
        [type=email]:focus,
        [type=month]:focus,
        [type=number]:focus,
        [type=password]:focus,
        [type=search]:focus,
        [type=tel]:focus,
        [type=text]:focus,
        [type=time]:focus,
        [type=url]:focus,
        [type=week]:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid #0000;
            outline-offset: 2px;
            --tw-ring-inset: var(--tw-empty,
                    /*!*/
                    /*!*/
                );
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: #1c64f2;
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow);
            border-color: #1c64f2
        }

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            color: #6b7280;
            opacity: 1
        }

        input::placeholder,
        textarea::placeholder {
            color: #6b7280;
            opacity: 1
        }

        ::-webkit-datetime-edit-fields-wrapper {
            padding: 0
        }

        ::-webkit-date-and-time-value {
            min-height: 1.5em
        }

        select:not([size]) {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3E%3C/svg%3E");
            background-position: right .5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact
        }

        [multiple] {
            background-image: none;
            background-position: 0 0;
            background-repeat: unset;
            background-size: initial;
            padding-right: .75rem;
            -webkit-print-color-adjust: unset;
            print-color-adjust: unset
        }

        [type=checkbox],
        [type=radio] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            display: inline-block;
            vertical-align: middle;
            background-origin: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            flex-shrink: 0;
            height: 1rem;
            width: 1rem;
            color: #1c64f2;
            background-color: #fff;
            border-color: #6b7280;
            border-width: 1px;
            --tw-shadow: 0 0 #0000
        }

        [type=checkbox] {
            border-radius: 0
        }

        [type=radio] {
            border-radius: 100%
        }

        [type=checkbox]:focus,
        [type=radio]:focus {
            outline: 2px solid #0000;
            outline-offset: 2px;
            --tw-ring-inset: var(--tw-empty,
                    /*!*/
                    /*!*/
                );
            --tw-ring-offset-width: 2px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: #1c64f2;
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow)
        }

        .dark [type=checkbox]:checked,
        .dark [type=radio]:checked,
        [type=checkbox]:checked,
        [type=radio]:checked {
            border-color: #0000;
            background-color: currentColor;
            background-size: 100% 100%;
            background-position: 50%;
            background-repeat: no-repeat
        }

        [type=checkbox]:checked {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg viewBox='0 0 16 16' fill='%23fff' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12.207 4.793a1 1 0 0 1 0 1.414l-5 5a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L6.5 9.086l4.293-4.293a1 1 0 0 1 1.414 0z'/%3E%3C/svg%3E")
        }

        [type=radio]:checked {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg viewBox='0 0 16 16' fill='%23fff' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='8' cy='8' r='3'/%3E%3C/svg%3E")
        }

        [type=checkbox]:indeterminate {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 16 16'%3E%3Cpath stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8h8'/%3E%3C/svg%3E");
            background-size: 100% 100%;
            background-position: 50%;
            background-repeat: no-repeat
        }

        [type=checkbox]:indeterminate,
        [type=checkbox]:indeterminate:focus,
        [type=checkbox]:indeterminate:hover {
            border-color: #0000;
            background-color: currentColor
        }

        [type=file] {
            background: unset;
            border-color: inherit;
            border-width: 0;
            border-radius: 0;
            padding: 0;
            font-size: unset;
            line-height: inherit
        }

        [type=file]:focus {
            outline: 1px auto inherit
        }

        input[type=file]::file-selector-button {
            color: #fff;
            background: #1f2937;
            border: 0;
            font-weight: 500;
            font-size: .875rem;
            cursor: pointer;
            padding: .625rem 1rem .625rem 2rem;
            -webkit-margin-start: -1rem;
            margin-inline-start: -1rem;
            -webkit-margin-end: 1rem;
            margin-inline-end: 1rem
        }

        input[type=file]::file-selector-button:hover {
            background: #374151
        }

        .dark input[type=file]::file-selector-button {
            color: #fff;
            background: #4b5563
        }

        .dark input[type=file]::file-selector-button:hover {
            background: #6b7280
        }

        input[type=range]::-webkit-slider-thumb {
            height: 1.25rem;
            width: 1.25rem;
            background: #1c64f2;
            border-radius: 9999px;
            border: 0;
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;
            cursor: pointer
        }

        input[type=range]:disabled::-webkit-slider-thumb {
            background: #9ca3af
        }

        .dark input[type=range]:disabled::-webkit-slider-thumb {
            background: #6b7280
        }

        input[type=range]:focus::-webkit-slider-thumb {
            outline: 2px solid #0000;
            outline-offset: 2px;
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(4px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
            --tw-ring-opacity: 1px;
            --tw-ring-color: rgb(164 202 254/var(--tw-ring-opacity))
        }

        input[type=range]::-moz-range-thumb {
            height: 1.25rem;
            width: 1.25rem;
            background: #1c64f2;
            border-radius: 9999px;
            border: 0;
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;
            cursor: pointer
        }

        input[type=range]:disabled::-moz-range-thumb {
            background: #9ca3af
        }

        .dark input[type=range]:disabled::-moz-range-thumb {
            background: #6b7280
        }

        input[type=range]::-moz-range-progress {
            background: #3f83f8
        }

        input[type=range]::-ms-fill-lower {
            background: #3f83f8
        }

        .toggle-bg:after {
            content: "";
            position: absolute;
            top: .125rem;
            left: .125rem;
            background: #fff;
            border-color: #d1d5db;
            border-width: 1px;
            border-radius: 9999px;
            height: 1.25rem;
            width: 1.25rem;
            transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-backdrop-filter;
            transition-duration: .15s;
            box-shadow: var(--tw-ring-inset) 0 0 0 calc(var(--tw-ring-offset-width)) var(--tw-ring-color)
        }

        input:checked+.toggle-bg:after {
            transform: translateX(100%);
            ;
            border-color: #fff
        }

        input:checked+.toggle-bg {
            background: #1c64f2;
            border-color: #1c64f2
        }

        .tooltip-arrow,
        .tooltip-arrow:before {
            position: absolute;
            width: 8px;
            height: 8px;
            background: inherit
        }

        .tooltip-arrow {
            visibility: hidden
        }

        .tooltip-arrow:before {
            content: "";
            visibility: visible;
            transform: rotate(45deg)
        }

        [data-tooltip-style^=light]+.tooltip>.tooltip-arrow:before {
            border-style: solid;
            border-color: #e5e7eb
        }

        [data-tooltip-style^=light]+.tooltip[data-popper-placement^=top]>.tooltip-arrow:before {
            border-bottom-width: 1px;
            border-right-width: 1px
        }

        [data-tooltip-style^=light]+.tooltip[data-popper-placement^=right]>.tooltip-arrow:before {
            border-bottom-width: 1px;
            border-left-width: 1px
        }

        [data-tooltip-style^=light]+.tooltip[data-popper-placement^=bottom]>.tooltip-arrow:before {
            border-top-width: 1px;
            border-left-width: 1px
        }

        [data-tooltip-style^=light]+.tooltip[data-popper-placement^=left]>.tooltip-arrow:before {
            border-top-width: 1px;
            border-right-width: 1px
        }

        .tooltip[data-popper-placement^=top]>.tooltip-arrow {
            bottom: -4px
        }

        .tooltip[data-popper-placement^=bottom]>.tooltip-arrow {
            top: -4px
        }

        .tooltip[data-popper-placement^=left]>.tooltip-arrow {
            right: -4px
        }

        .tooltip[data-popper-placement^=right]>.tooltip-arrow {
            left: -4px
        }

        .tooltip.invisible>.tooltip-arrow:before {
            visibility: hidden
        }

        [data-popper-arrow],
        [data-popper-arrow]:before {
            position: absolute;
            width: 8px;
            height: 8px;
            background: inherit
        }

        [data-popper-arrow] {
            visibility: hidden
        }

        [data-popper-arrow]:after,
        [data-popper-arrow]:before {
            content: "";
            visibility: visible;
            transform: rotate(45deg)
        }

        [data-popper-arrow]:after {
            position: absolute;
            width: 9px;
            height: 9px;
            background: inherit
        }

        [role=tooltip]>[data-popper-arrow]:before {
            border-style: solid;
            border-color: #e5e7eb
        }

        .dark [role=tooltip]>[data-popper-arrow]:before {
            border-style: solid;
            border-color: #4b5563
        }

        [role=tooltip]>[data-popper-arrow]:after {
            border-style: solid;
            border-color: #e5e7eb
        }

        .dark [role=tooltip]>[data-popper-arrow]:after {
            border-style: solid;
            border-color: #4b5563
        }

        [data-popover][role=tooltip][data-popper-placement^=top]>[data-popper-arrow]:after,
        [data-popover][role=tooltip][data-popper-placement^=top]>[data-popper-arrow]:before {
            border-bottom-width: 1px;
            border-right-width: 1px
        }

        [data-popover][role=tooltip][data-popper-placement^=right]>[data-popper-arrow]:after,
        [data-popover][role=tooltip][data-popper-placement^=right]>[data-popper-arrow]:before {
            border-bottom-width: 1px;
            border-left-width: 1px
        }

        [data-popover][role=tooltip][data-popper-placement^=bottom]>[data-popper-arrow]:after,
        [data-popover][role=tooltip][data-popper-placement^=bottom]>[data-popper-arrow]:before {
            border-top-width: 1px;
            border-left-width: 1px
        }

        [data-popover][role=tooltip][data-popper-placement^=left]>[data-popper-arrow]:after,
        [data-popover][role=tooltip][data-popper-placement^=left]>[data-popper-arrow]:before {
            border-top-width: 1px;
            border-right-width: 1px
        }

        [data-popover][role=tooltip][data-popper-placement^=top]>[data-popper-arrow] {
            bottom: -5px
        }

        [data-popover][role=tooltip][data-popper-placement^=bottom]>[data-popper-arrow] {
            top: -5px
        }

        [data-popover][role=tooltip][data-popper-placement^=left]>[data-popper-arrow] {
            right: -5px
        }

        [data-popover][role=tooltip][data-popper-placement^=right]>[data-popper-arrow] {
            left: -5px
        }

        [role=tooltip].invisible>[data-popper-arrow]:after,
        [role=tooltip].invisible>[data-popper-arrow]:before {
            visibility: hidden
        }

        *,
        ::backdrop,
        :after,
        :before {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: #3f83f880;
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .container {
            width: 100%
        }

        @media (min-width:640px) {
            .container {
                max-width: 640px
            }
        }

        @media (min-width:768px) {
            .container {
                max-width: 768px
            }
        }

        @media (min-width:1024px) {
            .container {
                max-width: 1024px
            }
        }

        @media (min-width:1280px) {
            .container {
                max-width: 1280px
            }
        }

        @media (min-width:1536px) {
            .container {
                max-width: 1536px
            }
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0
        }

        .visible {
            visibility: visible
        }

        .invisible {
            visibility: hidden
        }

        .collapse {
            visibility: collapse
        }

        .static {
            position: static
        }

        .fixed {
            position: fixed
        }

        .absolute {
            position: absolute
        }

        .relative {
            position: relative
        }

        .inset-0 {
            top: 0;
            right: 0;
            bottom: 0;
            left: 0
        }

        .-left-3 {
            left: -.75rem
        }

        .bottom-0 {
            bottom: 0
        }

        .bottom-\[60px\] {
            bottom: 60px
        }

        .left-0 {
            left: 0
        }

        .right-0 {
            right: 0
        }

        .top-0 {
            top: 0
        }

        .z-0 {
            z-index: 0
        }

        .z-10 {
            z-index: 10
        }

        .z-20 {
            z-index: 20
        }

        .z-30 {
            z-index: 30
        }

        .z-40 {
            z-index: 40
        }

        .z-50 {
            z-index: 50
        }

        .float-right {
            float: right
        }

        .m-auto {
            margin: auto
        }

        .-mx-1 {
            margin-left: -.25rem;
            margin-right: -.25rem
        }

        .mx-6 {
            margin-left: 1.5rem;
            margin-right: 1.5rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .my-3 {
            margin-top: .75rem;
            margin-bottom: .75rem
        }

        .my-4 {
            margin-top: 1rem;
            margin-bottom: 1rem
        }

        .my-6 {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem
        }

        .-ml-px {
            margin-left: -1px
        }

        .-mr-2 {
            margin-right: -.5rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .mb-1 {
            margin-bottom: .25rem
        }

        .mb-2 {
            margin-bottom: .5rem
        }

        .mb-3 {
            margin-bottom: .75rem
        }

        .mb-4 {
            margin-bottom: 1rem
        }

        .mb-5 {
            margin-bottom: 1.25rem
        }

        .mb-6 {
            margin-bottom: 1.5rem
        }

        .ml-1 {
            margin-left: .25rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .ml-3 {
            margin-left: .75rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .ml-5 {
            margin-left: 1.25rem
        }

        .ml-auto {
            margin-left: auto
        }

        .mr-1 {
            margin-right: .25rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .mt-1 {
            margin-top: .25rem
        }

        .mt-10 {
            margin-top: 2.5rem
        }

        .mt-12 {
            margin-top: 3rem
        }

        .mt-16 {
            margin-top: 4rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mt-20 {
            margin-top: 5rem
        }

        .mt-28 {
            margin-top: 7rem
        }

        .mt-3 {
            margin-top: .75rem
        }

        .mt-32 {
            margin-top: 8rem
        }

        .mt-36 {
            margin-top: 9rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .mt-5 {
            margin-top: 1.25rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .block {
            display: block
        }

        .inline-block {
            display: inline-block
        }

        .inline {
            display: inline
        }

        .flex {
            display: flex
        }

        .inline-flex {
            display: inline-flex
        }

        .table {
            display: table
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .h-14 {
            height: 3.5rem
        }

        .h-16 {
            height: 4rem
        }

        .h-4 {
            height: 1rem
        }

        .h-44 {
            height: 11rem
        }

        .h-5 {
            height: 1.25rem
        }

        .h-6 {
            height: 1.5rem
        }

        .h-7 {
            height: 1.75rem
        }

        .h-8 {
            height: 2rem
        }

        .h-9 {
            height: 2.25rem
        }

        .h-\[calc\(100\%-1rem\)\] {
            height: calc(100% - 1rem)
        }

        .h-full {
            height: 100%
        }

        .h-screen {
            height: 100vh
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-1\/2 {
            width: 50%
        }

        .w-1\/4 {
            width: 25%
        }

        .w-1\/5 {
            width: 20%
        }

        .w-1\/6 {
            width: 16.666667%
        }

        .w-12 {
            width: 3rem
        }

        .w-14 {
            width: 3.5rem
        }

        .w-16 {
            width: 4rem
        }

        .w-20 {
            width: 5rem
        }

        .w-28 {
            width: 7rem
        }

        .w-3\/4 {
            width: 75%
        }

        .w-32 {
            width: 8rem
        }

        .w-36 {
            width: 9rem
        }

        .w-4 {
            width: 1rem
        }

        .w-4\/5 {
            width: 80%
        }

        .w-44 {
            width: 11rem
        }

        .w-48 {
            width: 12rem
        }

        .w-5 {
            width: 1.25rem
        }

        .w-56 {
            width: 14rem
        }

        .w-6 {
            width: 1.5rem
        }

        .w-64 {
            width: 16rem
        }

        .w-7 {
            width: 1.75rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .w-full {
            width: 100%
        }

        .w-screen {
            width: 100vw
        }

        .max-w-2xl {
            max-width: 42rem
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .max-w-7xl {
            max-width: 80rem
        }

        .max-w-xl {
            max-width: 36rem
        }

        .flex-1 {
            flex: 1 1 0%
        }

        .flex-shrink {
            flex-shrink: 1
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .grow {
            flex-grow: 1
        }

        .border-collapse {
            border-collapse: collapse
        }

        .origin-top {
            transform-origin: top
        }

        .origin-top-left {
            transform-origin: top left
        }

        .origin-top-right {
            transform-origin: top right
        }

        .-translate-x-full {
            --tw-translate-x: -100%
        }

        .-translate-x-full,
        .-translate-y-full {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .-translate-y-full {
            --tw-translate-y: -100%
        }

        .translate-x-0 {
            --tw-translate-x: 0px
        }

        .translate-x-0,
        .translate-x-full {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .translate-x-full {
            --tw-translate-x: 100%
        }

        .translate-y-0 {
            --tw-translate-y: 0px
        }

        .translate-y-0,
        .translate-y-4 {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .translate-y-4 {
            --tw-translate-y: 1rem
        }

        .translate-y-full {
            --tw-translate-y: 100%
        }

        .rotate-180,
        .translate-y-full {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .rotate-180 {
            --tw-rotate: 180deg
        }

        .scale-100 {
            --tw-scale-x: 1;
            --tw-scale-y: 1
        }

        .scale-100,
        .scale-95 {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .scale-95 {
            --tw-scale-x: .95;
            --tw-scale-y: .95
        }

        .transform {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .transform-none {
            transform: none
        }

        .cursor-default {
            cursor: default
        }

        .cursor-not-allowed {
            cursor: not-allowed
        }

        .cursor-pointer {
            cursor: pointer
        }

        .select-none {
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none
        }

        .resize {
            resize: both
        }

        .list-disc {
            list-style-type: disc
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .grid-cols-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr))
        }

        .grid-cols-7 {
            grid-template-columns: repeat(7, minmax(0, 1fr))
        }

        .flex-col {
            flex-direction: column
        }

        .flex-wrap {
            flex-wrap: wrap
        }

        .items-start {
            align-items: flex-start
        }

        .items-end {
            align-items: flex-end
        }

        .items-center {
            align-items: center
        }

        .justify-start {
            justify-content: flex-start
        }

        .justify-end {
            justify-content: flex-end
        }

        .justify-center {
            justify-content: center
        }

        .justify-between {
            justify-content: space-between
        }

        .justify-items-center {
            justify-items: center
        }

        .gap-0 {
            gap: 0
        }

        .gap-1 {
            gap: .25rem
        }

        .gap-10 {
            gap: 2.5rem
        }

        .gap-2 {
            gap: .5rem
        }

        .gap-3 {
            gap: .75rem
        }

        .gap-4 {
            gap: 1rem
        }

        .gap-5 {
            gap: 1.25rem
        }

        .gap-6 {
            gap: 1.5rem
        }

        .space-x-16>:not([hidden])~:not([hidden]) {
            --tw-space-x-reverse: 0;
            margin-right: calc(4rem*var(--tw-space-x-reverse));
            margin-left: calc(4rem*(1 - var(--tw-space-x-reverse)))
        }

        .space-x-2>:not([hidden])~:not([hidden]) {
            --tw-space-x-reverse: 0;
            margin-right: calc(.5rem*var(--tw-space-x-reverse));
            margin-left: calc(.5rem*(1 - var(--tw-space-x-reverse)))
        }

        .space-x-8>:not([hidden])~:not([hidden]) {
            --tw-space-x-reverse: 0;
            margin-right: calc(2rem*var(--tw-space-x-reverse));
            margin-left: calc(2rem*(1 - var(--tw-space-x-reverse)))
        }

        .space-y-1>:not([hidden])~:not([hidden]) {
            --tw-space-y-reverse: 0;
            margin-top: calc(.25rem*(1 - var(--tw-space-y-reverse)));
            margin-bottom: calc(.25rem*var(--tw-space-y-reverse))
        }

        .space-y-6>:not([hidden])~:not([hidden]) {
            --tw-space-y-reverse: 0;
            margin-top: calc(1.5rem*(1 - var(--tw-space-y-reverse)));
            margin-bottom: calc(1.5rem*var(--tw-space-y-reverse))
        }

        .self-center {
            align-self: center
        }

        .overflow-hidden {
            overflow: hidden
        }

        .overflow-y-auto {
            overflow-y: auto
        }

        .overflow-x-hidden {
            overflow-x: hidden
        }

        .overflow-y-hidden {
            overflow-y: hidden
        }

        .text-clip {
            text-overflow: clip
        }

        .rounded {
            border-radius: .25rem
        }

        .rounded-full {
            border-radius: 9999px
        }

        .rounded-lg {
            border-radius: .5rem
        }

        .rounded-md {
            border-radius: .375rem
        }

        .rounded-b {
            border-bottom-right-radius: .25rem
        }

        .rounded-b,
        .rounded-l {
            border-bottom-left-radius: .25rem
        }

        .rounded-l {
            border-top-left-radius: .25rem
        }

        .rounded-l-lg {
            border-top-left-radius: .5rem;
            border-bottom-left-radius: .5rem
        }

        .rounded-l-md {
            border-top-left-radius: .375rem;
            border-bottom-left-radius: .375rem
        }

        .rounded-r {
            border-top-right-radius: .25rem;
            border-bottom-right-radius: .25rem
        }

        .rounded-r-full {
            border-top-right-radius: 9999px;
            border-bottom-right-radius: 9999px
        }

        .rounded-r-lg {
            border-top-right-radius: .5rem;
            border-bottom-right-radius: .5rem
        }

        .rounded-r-md {
            border-top-right-radius: .375rem;
            border-bottom-right-radius: .375rem
        }

        .rounded-t {
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem
        }

        .border {
            border-width: 1px
        }

        .border-0 {
            border-width: 0
        }

        .border-b {
            border-bottom-width: 1px
        }

        .border-b-2 {
            border-bottom-width: 2px
        }

        .border-l-0 {
            border-left-width: 0
        }

        .border-l-4 {
            border-left-width: 4px
        }

        .border-r {
            border-right-width: 1px
        }

        .border-r-0 {
            border-right-width: 0
        }

        .border-t {
            border-top-width: 1px
        }

        .border-t-0 {
            border-top-width: 0
        }

        .border-blue-600 {
            --tw-border-opacity: 1;
            border-color: rgb(28 100 242/var(--tw-border-opacity))
        }

        .border-blue-700 {
            --tw-border-opacity: 1;
            border-color: rgb(26 86 219/var(--tw-border-opacity))
        }

        .border-citrablack {
            --tw-border-opacity: 1;
            border-color: rgb(27 18 18/var(--tw-border-opacity))
        }

        .border-gray-100 {
            --tw-border-opacity: 1;
            border-color: rgb(243 244 246/var(--tw-border-opacity))
        }

        .border-gray-200 {
            --tw-border-opacity: 1;
            border-color: rgb(229 231 235/var(--tw-border-opacity))
        }

        .border-gray-300 {
            --tw-border-opacity: 1;
            border-color: rgb(209 213 219/var(--tw-border-opacity))
        }

        .border-gray-400 {
            --tw-border-opacity: 1;
            border-color: rgb(156 163 175/var(--tw-border-opacity))
        }

        .border-indigo-400 {
            --tw-border-opacity: 1;
            border-color: rgb(141 162 251/var(--tw-border-opacity))
        }

        .border-transparent {
            border-color: #0000
        }

        .border-zinc-200 {
            --tw-border-opacity: 1;
            border-color: rgb(228 228 231/var(--tw-border-opacity))
        }

        .border-zinc-400 {
            --tw-border-opacity: 1;
            border-color: rgb(161 161 170/var(--tw-border-opacity))
        }

        .border-b-citragreen-500 {
            --tw-border-opacity: 1;
            border-bottom-color: rgb(45 165 92/var(--tw-border-opacity))
        }

        .border-b-zinc-400 {
            --tw-border-opacity: 1;
            border-bottom-color: rgb(161 161 170/var(--tw-border-opacity))
        }

        .bg-blue-200 {
            --tw-bg-opacity: 1;
            background-color: rgb(195 221 253/var(--tw-bg-opacity))
        }

        .bg-blue-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(63 131 248/var(--tw-bg-opacity))
        }

        .bg-blue-700 {
            --tw-bg-opacity: 1;
            background-color: rgb(26 86 219/var(--tw-bg-opacity))
        }

        .bg-citrablue-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(212 230 254/var(--tw-bg-opacity))
        }

        .bg-citradark-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(223 243 246/var(--tw-bg-opacity))
        }

        .bg-citradark-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(47 72 88/var(--tw-bg-opacity))
        }

        .bg-citragreen-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(214 250 214/var(--tw-bg-opacity))
        }

        .bg-citragreen-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(45 165 92/var(--tw-bg-opacity))
        }

        .bg-citrared-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(253 218 212/var(--tw-bg-opacity))
        }

        .bg-citrared-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(224 42 82/var(--tw-bg-opacity))
        }

        .bg-citrayellow-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(255 245 204/var(--tw-bg-opacity))
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246/var(--tw-bg-opacity))
        }

        .bg-gray-200 {
            --tw-bg-opacity: 1;
            background-color: rgb(229 231 235/var(--tw-bg-opacity))
        }

        .bg-gray-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(107 114 128/var(--tw-bg-opacity))
        }

        .bg-gray-800 {
            --tw-bg-opacity: 1;
            background-color: rgb(31 41 55/var(--tw-bg-opacity))
        }

        .bg-gray-900 {
            --tw-bg-opacity: 1;
            background-color: rgb(17 24 39/var(--tw-bg-opacity))
        }

        .bg-indigo-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(240 245 255/var(--tw-bg-opacity))
        }

        .bg-red-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(253 242 242/var(--tw-bg-opacity))
        }

        .bg-red-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(240 82 82/var(--tw-bg-opacity))
        }

        .bg-red-600 {
            --tw-bg-opacity: 1;
            background-color: rgb(224 36 36/var(--tw-bg-opacity))
        }

        .bg-red-800 {
            --tw-bg-opacity: 1;
            background-color: rgb(155 28 28/var(--tw-bg-opacity))
        }

        .bg-transparent {
            background-color: initial
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255/var(--tw-bg-opacity))
        }

        .bg-white\/50 {
            background-color: #ffffff80
        }

        .bg-zinc-200 {
            --tw-bg-opacity: 1;
            background-color: rgb(228 228 231/var(--tw-bg-opacity))
        }

        .bg-opacity-50 {
            --tw-bg-opacity: 0.5
        }

        .bg-gradient-to-b {
            background-image: linear-gradient(to bottom, var(--tw-gradient-stops))
        }

        .from-citragreen-400 {
            --tw-gradient-from: #5bc97b;
            --tw-gradient-to: #5bc97b00;
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .from-gray-700 {
            --tw-gradient-from: #374151;
            --tw-gradient-to: #37415100;
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .from-gray-700\/50 {
            --tw-gradient-from: #37415180;
            --tw-gradient-to: #37415100;
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-transparent {
            --tw-gradient-to: #0000;
            --tw-gradient-stops: var(--tw-gradient-from), #0000, var(--tw-gradient-to)
        }

        .to-citragreen-600 {
            --tw-gradient-to: #208d56
        }

        .bg-center {
            background-position: 50%
        }

        .fill-current {
            fill: currentColor
        }

        .stroke-gray-400 {
            stroke: #9ca3af
        }

        .stroke-gray-600 {
            stroke: #4b5563
        }

        .stroke-red-500 {
            stroke: #f05252
        }

        .p-1 {
            padding: .25rem
        }

        .p-1\.5 {
            padding: .375rem
        }

        .p-10 {
            padding: 2.5rem
        }

        .p-2 {
            padding: .5rem
        }

        .p-2\.5 {
            padding: .625rem
        }

        .p-3 {
            padding: .75rem
        }

        .p-4 {
            padding: 1rem
        }

        .p-5 {
            padding: 1.25rem
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-0 {
            padding-left: 0;
            padding-right: 0
        }

        .px-1 {
            padding-left: .25rem;
            padding-right: .25rem
        }

        .px-10 {
            padding-left: 2.5rem;
            padding-right: 2.5rem
        }

        .px-2 {
            padding-left: .5rem;
            padding-right: .5rem
        }

        .px-28 {
            padding-left: 7rem;
            padding-right: 7rem
        }

        .px-3 {
            padding-left: .75rem;
            padding-right: .75rem
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem
        }

        .px-5 {
            padding-left: 1.25rem;
            padding-right: 1.25rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .py-1 {
            padding-top: .25rem;
            padding-bottom: .25rem
        }

        .py-10 {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem
        }

        .py-12 {
            padding-top: 3rem;
            padding-bottom: 3rem
        }

        .py-2 {
            padding-top: .5rem;
            padding-bottom: .5rem
        }

        .py-2\.5 {
            padding-top: .625rem;
            padding-bottom: .625rem
        }

        .py-3 {
            padding-top: .75rem;
            padding-bottom: .75rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .py-5 {
            padding-top: 1.25rem;
            padding-bottom: 1.25rem
        }

        .py-6 {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem
        }

        .pb-1 {
            padding-bottom: .25rem
        }

        .pb-24 {
            padding-bottom: 6rem
        }

        .pb-3 {
            padding-bottom: .75rem
        }

        .pl-20 {
            padding-left: 5rem
        }

        .pl-3 {
            padding-left: .75rem
        }

        .pl-4 {
            padding-left: 1rem
        }

        .pr-10 {
            padding-right: 2.5rem
        }

        .pr-4 {
            padding-right: 1rem
        }

        .pt-1 {
            padding-top: .25rem
        }

        .pt-2 {
            padding-top: .5rem
        }

        .pt-32 {
            padding-top: 8rem
        }

        .pt-4 {
            padding-top: 1rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .text-left {
            text-align: left
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .font-sans {
            font-family: Roboto, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji
        }

        .text-2xl {
            font-size: 1.5rem;
            line-height: 2rem
        }

        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem
        }

        .text-4xl {
            font-size: 2.25rem;
            line-height: 2.5rem
        }

        .text-8xl {
            font-size: 6rem;
            line-height: 1
        }

        .text-base {
            font-size: 1rem;
            line-height: 1.5rem
        }

        .text-lg {
            font-size: 1.125rem;
            line-height: 1.75rem
        }

        .text-sm {
            font-size: .875rem;
            line-height: 1.25rem
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .text-xs {
            font-size: .75rem;
            line-height: 1rem
        }

        .font-bold {
            font-weight: 700
        }

        .font-medium {
            font-weight: 500
        }

        .font-normal {
            font-weight: 400
        }

        .font-semibold {
            font-weight: 600
        }

        .uppercase {
            text-transform: uppercase
        }

        .italic {
            font-style: italic
        }

        .leading-4 {
            line-height: 1rem
        }

        .leading-5 {
            line-height: 1.25rem
        }

        .leading-6 {
            line-height: 1.5rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .leading-9 {
            line-height: 2.25rem
        }

        .leading-loose {
            line-height: 2
        }

        .leading-none {
            line-height: 1
        }

        .leading-relaxed {
            line-height: 1.625
        }

        .leading-tight {
            line-height: 1.25
        }

        .tracking-wider {
            letter-spacing: .05em
        }

        .tracking-widest {
            letter-spacing: .1em
        }

        .text-blue-600 {
            --tw-text-opacity: 1;
            color: rgb(28 100 242/var(--tw-text-opacity))
        }

        .text-citrablack {
            --tw-text-opacity: 1;
            color: rgb(27 18 18/var(--tw-text-opacity))
        }

        .text-citrablue-500 {
            --tw-text-opacity: 1;
            color: rgb(42 105 252/var(--tw-text-opacity))
        }

        .text-citradark-500 {
            --tw-text-opacity: 1;
            color: rgb(47 72 88/var(--tw-text-opacity))
        }

        .text-citragreen-100 {
            --tw-text-opacity: 1;
            color: rgb(214 250 214/var(--tw-text-opacity))
        }

        .text-citragreen-500 {
            --tw-text-opacity: 1;
            color: rgb(45 165 92/var(--tw-text-opacity))
        }

        .text-citrared-500 {
            --tw-text-opacity: 1;
            color: rgb(224 42 82/var(--tw-text-opacity))
        }

        .text-citrayellow-500 {
            --tw-text-opacity: 1;
            color: rgb(255 178 0/var(--tw-text-opacity))
        }

        .text-gray-200 {
            --tw-text-opacity: 1;
            color: rgb(229 231 235/var(--tw-text-opacity))
        }

        .text-gray-300 {
            --tw-text-opacity: 1;
            color: rgb(209 213 219/var(--tw-text-opacity))
        }

        .text-gray-400 {
            --tw-text-opacity: 1;
            color: rgb(156 163 175/var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128/var(--tw-text-opacity))
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99/var(--tw-text-opacity))
        }

        .text-gray-700 {
            --tw-text-opacity: 1;
            color: rgb(55 65 81/var(--tw-text-opacity))
        }

        .text-gray-800 {
            --tw-text-opacity: 1;
            color: rgb(31 41 55/var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39/var(--tw-text-opacity))
        }

        .text-green-600 {
            --tw-text-opacity: 1;
            color: rgb(5 122 85/var(--tw-text-opacity))
        }

        .text-indigo-600 {
            --tw-text-opacity: 1;
            color: rgb(88 80 236/var(--tw-text-opacity))
        }

        .text-indigo-700 {
            --tw-text-opacity: 1;
            color: rgb(81 69 205/var(--tw-text-opacity))
        }

        .text-red-500 {
            --tw-text-opacity: 1;
            color: rgb(240 82 82/var(--tw-text-opacity))
        }

        .text-red-600 {
            --tw-text-opacity: 1;
            color: rgb(224 36 36/var(--tw-text-opacity))
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255/var(--tw-text-opacity))
        }

        .text-zinc-400 {
            --tw-text-opacity: 1;
            color: rgb(161 161 170/var(--tw-text-opacity))
        }

        .text-zinc-500 {
            --tw-text-opacity: 1;
            color: rgb(113 113 122/var(--tw-text-opacity))
        }

        .underline {
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .placeholder-zinc-400::-moz-placeholder {
            --tw-placeholder-opacity: 1;
            color: rgb(161 161 170/var(--tw-placeholder-opacity))
        }

        .placeholder-zinc-400::placeholder {
            --tw-placeholder-opacity: 1;
            color: rgb(161 161 170/var(--tw-placeholder-opacity))
        }

        .accent-citragreen-500 {
            accent-color: #2da55c
        }

        .opacity-0 {
            opacity: 0
        }

        .opacity-100 {
            opacity: 1
        }

        .opacity-25 {
            opacity: .25
        }

        .opacity-75 {
            opacity: .75
        }

        .shadow {
            --tw-shadow: 0 1px 3px 0 #0000001a, 0 1px 2px -1px #0000001a;
            --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color)
        }

        .shadow,
        .shadow-2xl {
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-2xl {
            --tw-shadow: 0 25px 50px -12px #00000040;
            --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color)
        }

        .shadow-lg {
            --tw-shadow: 0 10px 15px -3px #0000001a, 0 4px 6px -4px #0000001a;
            --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color)
        }

        .shadow-lg,
        .shadow-md {
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-md {
            --tw-shadow: 0 4px 6px -1px #0000001a, 0 2px 4px -2px #0000001a;
            --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color)
        }

        .shadow-sm {
            --tw-shadow: 0 1px 2px 0 #0000000d;
            --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color)
        }

        .shadow-sm,
        .shadow-xl {
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-xl {
            --tw-shadow: 0 20px 25px -5px #0000001a, 0 8px 10px -6px #0000001a;
            --tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color)
        }

        .shadow-gray-500\/20 {
            --tw-shadow-color: #6b728033;
            --tw-shadow: var(--tw-shadow-colored)
        }

        .outline {
            outline-style: solid
        }

        .ring-1 {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .ring-black {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(0 0 0/var(--tw-ring-opacity))
        }

        .ring-gray-300 {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(209 213 219/var(--tw-ring-opacity))
        }

        .ring-white {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(255 255 255/var(--tw-ring-opacity))
        }

        .ring-opacity-5 {
            --tw-ring-opacity: 0.05
        }

        .blur {
            --tw-blur: blur(8px)
        }

        .blur,
        .filter {
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .transition {
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-backdrop-filter;
            transition-timing-function: cubic-bezier(.4, 0, .2, 1);
            transition-duration: .15s
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(.4, 0, .2, 1);
            transition-duration: .15s
        }

        .transition-opacity {
            transition-property: opacity;
            transition-timing-function: cubic-bezier(.4, 0, .2, 1);
            transition-duration: .15s
        }

        .transition-transform {
            transition-property: transform;
            transition-timing-function: cubic-bezier(.4, 0, .2, 1);
            transition-duration: .15s
        }

        .duration-100 {
            transition-duration: .1s
        }

        .duration-150 {
            transition-duration: .15s
        }

        .duration-200 {
            transition-duration: .2s
        }

        .duration-300 {
            transition-duration: .3s
        }

        .duration-75 {
            transition-duration: 75ms
        }

        .ease-in {
            transition-timing-function: cubic-bezier(.4, 0, 1, 1)
        }

        .ease-in-out {
            transition-timing-function: cubic-bezier(.4, 0, .2, 1)
        }

        .ease-out {
            transition-timing-function: cubic-bezier(0, 0, .2, 1)
        }

        .selection\:bg-red-500 ::-moz-selection {
            --tw-bg-opacity: 1;
            background-color: rgb(240 82 82/var(--tw-bg-opacity))
        }

        .selection\:bg-red-500 ::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(240 82 82/var(--tw-bg-opacity))
        }

        .selection\:text-white ::-moz-selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255/var(--tw-text-opacity))
        }

        .selection\:text-white ::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255/var(--tw-text-opacity))
        }

        .selection\:bg-red-500::-moz-selection {
            --tw-bg-opacity: 1;
            background-color: rgb(240 82 82/var(--tw-bg-opacity))
        }

        .selection\:bg-red-500::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(240 82 82/var(--tw-bg-opacity))
        }

        .selection\:text-white::-moz-selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255/var(--tw-text-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255/var(--tw-text-opacity))
        }

        .hover\:border-gray-300:hover {
            --tw-border-opacity: 1;
            border-color: rgb(209 213 219/var(--tw-border-opacity))
        }

        .hover\:bg-blue-200:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(195 221 253/var(--tw-bg-opacity))
        }

        .hover\:bg-blue-800:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(30 66 159/var(--tw-bg-opacity))
        }

        .hover\:bg-citradark-700:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(23 43 63/var(--tw-bg-opacity))
        }

        .hover\:bg-citrared-600:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(192 30 81/var(--tw-bg-opacity))
        }

        .hover\:bg-gray-100:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246/var(--tw-bg-opacity))
        }

        .hover\:bg-gray-200:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(229 231 235/var(--tw-bg-opacity))
        }

        .hover\:bg-gray-50:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(249 250 251/var(--tw-bg-opacity))
        }

        .hover\:bg-red-500:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(240 82 82/var(--tw-bg-opacity))
        }

        .hover\:bg-white:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255/var(--tw-bg-opacity))
        }

        .hover\:bg-zinc-200:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(228 228 231/var(--tw-bg-opacity))
        }

        .hover\:bg-zinc-300:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(212 212 216/var(--tw-bg-opacity))
        }

        .hover\:text-blue-600:hover {
            --tw-text-opacity: 1;
            color: rgb(28 100 242/var(--tw-text-opacity))
        }

        .hover\:text-citrablack:hover {
            --tw-text-opacity: 1;
            color: rgb(27 18 18/var(--tw-text-opacity))
        }

        .hover\:text-citragreen-500:hover {
            --tw-text-opacity: 1;
            color: rgb(45 165 92/var(--tw-text-opacity))
        }

        .hover\:text-gray-400:hover {
            --tw-text-opacity: 1;
            color: rgb(156 163 175/var(--tw-text-opacity))
        }

        .hover\:text-gray-500:hover {
            --tw-text-opacity: 1;
            color: rgb(107 114 128/var(--tw-text-opacity))
        }

        .hover\:text-gray-600:hover {
            --tw-text-opacity: 1;
            color: rgb(75 85 99/var(--tw-text-opacity))
        }

        .hover\:text-gray-700:hover {
            --tw-text-opacity: 1;
            color: rgb(55 65 81/var(--tw-text-opacity))
        }

        .hover\:text-gray-800:hover {
            --tw-text-opacity: 1;
            color: rgb(31 41 55/var(--tw-text-opacity))
        }

        .hover\:text-gray-900:hover {
            --tw-text-opacity: 1;
            color: rgb(17 24 39/var(--tw-text-opacity))
        }

        .focus\:z-10:focus {
            z-index: 10
        }

        .focus\:rounded-sm:focus {
            border-radius: .125rem
        }

        .focus\:border-blue-300:focus {
            --tw-border-opacity: 1;
            border-color: rgb(164 202 254/var(--tw-border-opacity))
        }

        .focus\:border-citragreen-500:focus {
            --tw-border-opacity: 1;
            border-color: rgb(45 165 92/var(--tw-border-opacity))
        }

        .focus\:border-gray-300:focus {
            --tw-border-opacity: 1;
            border-color: rgb(209 213 219/var(--tw-border-opacity))
        }

        .focus\:border-indigo-700:focus {
            --tw-border-opacity: 1;
            border-color: rgb(81 69 205/var(--tw-border-opacity))
        }

        .focus\:bg-citradark-400:focus {
            --tw-bg-opacity: 1;
            background-color: rgb(100 136 154/var(--tw-bg-opacity))
        }

        .focus\:bg-gray-100:focus {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246/var(--tw-bg-opacity))
        }

        .focus\:bg-gray-50:focus {
            --tw-bg-opacity: 1;
            background-color: rgb(249 250 251/var(--tw-bg-opacity))
        }

        .focus\:bg-indigo-100:focus {
            --tw-bg-opacity: 1;
            background-color: rgb(229 237 255/var(--tw-bg-opacity))
        }

        .focus\:bg-zinc-400:focus {
            --tw-bg-opacity: 1;
            background-color: rgb(161 161 170/var(--tw-bg-opacity))
        }

        .focus\:text-gray-500:focus {
            --tw-text-opacity: 1;
            color: rgb(107 114 128/var(--tw-text-opacity))
        }

        .focus\:text-gray-700:focus {
            --tw-text-opacity: 1;
            color: rgb(55 65 81/var(--tw-text-opacity))
        }

        .focus\:text-gray-800:focus {
            --tw-text-opacity: 1;
            color: rgb(31 41 55/var(--tw-text-opacity))
        }

        .focus\:text-indigo-800:focus {
            --tw-text-opacity: 1;
            color: rgb(66 56 157/var(--tw-text-opacity))
        }

        .focus\:outline-none:focus {
            outline: 2px solid #0000;
            outline-offset: 2px
        }

        .focus\:outline:focus {
            outline-style: solid
        }

        .focus\:outline-2:focus {
            outline-width: 2px
        }

        .focus\:outline-red-500:focus {
            outline-color: #f05252
        }

        .focus\:ring:focus {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color)
        }

        .focus\:ring-2:focus,
        .focus\:ring:focus {
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .focus\:ring-2:focus {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color)
        }

        .focus\:ring-4:focus {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(4px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .focus\:ring-blue-300:focus {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(164 202 254/var(--tw-ring-opacity))
        }

        .focus\:ring-citradark-500:focus {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(47 72 88/var(--tw-ring-opacity))
        }

        .focus\:ring-citragreen-500:focus {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(45 165 92/var(--tw-ring-opacity))
        }

        .focus\:ring-gray-200:focus {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(229 231 235/var(--tw-ring-opacity))
        }

        .focus\:ring-indigo-500:focus {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(104 117 245/var(--tw-ring-opacity))
        }

        .focus\:ring-red-500:focus {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(240 82 82/var(--tw-ring-opacity))
        }

        .focus\:ring-zinc-500:focus {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(113 113 122/var(--tw-ring-opacity))
        }

        .focus\:ring-opacity-30:focus {
            --tw-ring-opacity: 0.3
        }

        .focus\:ring-offset-2:focus {
            --tw-ring-offset-width: 2px
        }

        .active\:bg-citradark-600:active {
            --tw-bg-opacity: 1;
            background-color: rgb(34 57 75/var(--tw-bg-opacity))
        }

        .active\:bg-gray-100:active {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246/var(--tw-bg-opacity))
        }

        .active\:bg-red-700:active {
            --tw-bg-opacity: 1;
            background-color: rgb(200 30 30/var(--tw-bg-opacity))
        }

        .active\:bg-zinc-400:active {
            --tw-bg-opacity: 1;
            background-color: rgb(161 161 170/var(--tw-bg-opacity))
        }

        .active\:text-gray-500:active {
            --tw-text-opacity: 1;
            color: rgb(107 114 128/var(--tw-text-opacity))
        }

        .active\:text-gray-700:active {
            --tw-text-opacity: 1;
            color: rgb(55 65 81/var(--tw-text-opacity))
        }

        .disabled\:opacity-25:disabled {
            opacity: .25
        }

        .group:hover .group-hover\:stroke-gray-600 {
            stroke: #4b5563
        }

        .group:hover .group-hover\:text-citragreen-500 {
            --tw-text-opacity: 1;
            color: rgb(45 165 92/var(--tw-text-opacity))
        }

        .peer:checked~.peer-checked\:block {
            display: block
        }

        @media (prefers-reduced-motion:no-preference) {
            .motion-safe\:hover\:scale-\[1\.01\]:hover {
                --tw-scale-x: 1.01;
                --tw-scale-y: 1.01;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }
        }

        .dark .dark\:border-blue-500 {
            --tw-border-opacity: 1;
            border-color: rgb(63 131 248/var(--tw-border-opacity))
        }

        .dark .dark\:border-gray-600 {
            --tw-border-opacity: 1;
            border-color: rgb(75 85 99/var(--tw-border-opacity))
        }

        .dark .dark\:border-gray-700 {
            --tw-border-opacity: 1;
            border-color: rgb(55 65 81/var(--tw-border-opacity))
        }

        .dark .dark\:border-transparent {
            border-color: #0000
        }

        .dark .dark\:bg-blue-600 {
            --tw-bg-opacity: 1;
            background-color: rgb(28 100 242/var(--tw-bg-opacity))
        }

        .dark .dark\:bg-gray-600 {
            --tw-bg-opacity: 1;
            background-color: rgb(75 85 99/var(--tw-bg-opacity))
        }

        .dark .dark\:bg-gray-700 {
            --tw-bg-opacity: 1;
            background-color: rgb(55 65 81/var(--tw-bg-opacity))
        }

        .dark .dark\:bg-gray-800 {
            --tw-bg-opacity: 1;
            background-color: rgb(31 41 55/var(--tw-bg-opacity))
        }

        .dark .dark\:bg-gray-800\/50 {
            background-color: #1f293780
        }

        .dark .dark\:bg-gray-900 {
            --tw-bg-opacity: 1;
            background-color: rgb(17 24 39/var(--tw-bg-opacity))
        }

        .dark .dark\:bg-red-800\/20 {
            background-color: #9b1c1c33
        }

        .dark .dark\:bg-opacity-80 {
            --tw-bg-opacity: 0.8
        }

        .dark .dark\:bg-gradient-to-bl {
            background-image: linear-gradient(to bottom left, var(--tw-gradient-stops))
        }

        .dark .dark\:stroke-gray-600 {
            stroke: #4b5563
        }

        .dark .dark\:text-blue-500 {
            --tw-text-opacity: 1;
            color: rgb(63 131 248/var(--tw-text-opacity))
        }

        .dark .dark\:text-citragreen-500 {
            --tw-text-opacity: 1;
            color: rgb(45 165 92/var(--tw-text-opacity))
        }

        .dark .dark\:text-gray-400 {
            --tw-text-opacity: 1;
            color: rgb(156 163 175/var(--tw-text-opacity))
        }

        .dark .dark\:text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255/var(--tw-text-opacity))
        }

        .dark .dark\:text-zinc-200 {
            --tw-text-opacity: 1;
            color: rgb(228 228 231/var(--tw-text-opacity))
        }

        .dark .dark\:text-zinc-300 {
            --tw-text-opacity: 1;
            color: rgb(212 212 216/var(--tw-text-opacity))
        }

        .dark .dark\:text-zinc-400 {
            --tw-text-opacity: 1;
            color: rgb(161 161 170/var(--tw-text-opacity))
        }

        .dark .dark\:shadow-none {
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .dark .dark\:ring-1 {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .dark .dark\:ring-inset {
            --tw-ring-inset: inset
        }

        .dark .dark\:ring-white\/5 {
            --tw-ring-color: #ffffff0d
        }

        .dark .dark\:hover\:bg-blue-700:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(26 86 219/var(--tw-bg-opacity))
        }

        .dark .dark\:hover\:bg-gray-600:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(75 85 99/var(--tw-bg-opacity))
        }

        .dark .dark\:hover\:bg-gray-800:hover {
            --tw-bg-opacity: 1;
            background-color: rgb(31 41 55/var(--tw-bg-opacity))
        }

        .dark .dark\:hover\:text-blue-500:hover {
            --tw-text-opacity: 1;
            color: rgb(63 131 248/var(--tw-text-opacity))
        }

        .dark .dark\:hover\:text-citragreen-500:hover {
            --tw-text-opacity: 1;
            color: rgb(45 165 92/var(--tw-text-opacity))
        }

        .dark .dark\:hover\:text-gray-300:hover {
            --tw-text-opacity: 1;
            color: rgb(209 213 219/var(--tw-text-opacity))
        }

        .dark .dark\:hover\:text-white:hover {
            --tw-text-opacity: 1;
            color: rgb(255 255 255/var(--tw-text-opacity))
        }

        .dark .dark\:focus\:ring-opacity-30:focus {
            --tw-ring-opacity: 0.3
        }

        .dark .group:hover .dark\:group-hover\:stroke-gray-400 {
            stroke: #9ca3af
        }

        @media (min-width:640px) {
            .sm\:fixed {
                position: fixed
            }

            .sm\:right-0 {
                right: 0
            }

            .sm\:top-0 {
                top: 0
            }

            .sm\:-my-px {
                margin-top: -1px;
                margin-bottom: -1px
            }

            .sm\:mx-auto {
                margin-left: auto;
                margin-right: auto
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:ml-10 {
                margin-left: 2.5rem
            }

            .sm\:ml-6 {
                margin-left: 1.5rem
            }

            .sm\:flex {
                display: flex
            }

            .sm\:hidden {
                display: none
            }

            .sm\:w-full {
                width: 100%
            }

            .sm\:max-w-2xl {
                max-width: 42rem
            }

            .sm\:max-w-lg {
                max-width: 32rem
            }

            .sm\:max-w-md {
                max-width: 28rem
            }

            .sm\:max-w-sm {
                max-width: 24rem
            }

            .sm\:max-w-xl {
                max-width: 36rem
            }

            .sm\:flex-1 {
                flex: 1 1 0%
            }

            .sm\:translate-y-0 {
                --tw-translate-y: 0px
            }

            .sm\:scale-100,
            .sm\:translate-y-0 {
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }

            .sm\:scale-100 {
                --tw-scale-x: 1;
                --tw-scale-y: 1
            }

            .sm\:scale-95 {
                --tw-scale-x: .95;
                --tw-scale-y: .95;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-center {
                justify-content: center
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:rounded-md {
                border-radius: .375rem
            }

            .sm\:rounded-t-xl {
                border-top-left-radius: .75rem;
                border-top-right-radius: .75rem
            }

            .sm\:p-8 {
                padding: 2rem
            }

            .sm\:px-0 {
                padding-left: 0;
                padding-right: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:inset-0 {
                top: 0;
                right: 0;
                bottom: 0;
                left: 0
            }

            .md\:h-auto {
                height: auto
            }

            .md\:h-full {
                height: 100%
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .md\:py-10 {
                padding-top: 2.5rem;
                padding-bottom: 2.5rem
            }
        }

        @media (min-width:1024px) {
            .lg\:mt-0 {
                margin-top: 0
            }

            .lg\:flex-row {
                flex-direction: row
            }

            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-8 {
                padding: 2rem
            }

            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }
    </style>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="font-sans antialiased">
    <!-- Page Content -->
    <main class="mt-20">
        @yield('content')
    </main>
</body>

</html>
