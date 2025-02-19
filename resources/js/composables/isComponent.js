import { usePage } from "@inertiajs/vue3";

export const useIsComponent =  (component) => usePage().component === component