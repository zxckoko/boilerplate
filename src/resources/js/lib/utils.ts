// Reference: https://ayberkyavas.com/blogs/wtf-is-clsx-twmerge-cn-in-tailwindcss (Check this out)
import { clsx, type ClassValue } from "clsx"
import { twMerge } from "tailwind-merge"

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs))
}
