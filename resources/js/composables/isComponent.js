import { usePage } from "@inertiajs/vue3";

export const useIsComponent =  (component) => {
    return usePage().component == component
}