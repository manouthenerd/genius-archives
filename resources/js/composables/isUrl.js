import { usePage } from "@inertiajs/vue3"

export const useIsUrl = (url) => {
    return url === usePage().url
}