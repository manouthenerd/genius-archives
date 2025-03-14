export function useCarbonDateFormater() {

    const dateOnly = (date) => {
        
        return date.split('T')[0]
    }

    const timeOnly = (date) => {
        
        return date.split('T')[1].split('.')[0]
    }

    return {
        dateOnly,
        timeOnly
    }
}