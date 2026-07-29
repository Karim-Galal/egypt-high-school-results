export default function normalizeDigits(value) {
    return value.replace(/[٠-٩]/g, (digit) => {
        return "0123456789"["٠١٢٣٤٥٦٧٨٩".indexOf(digit)];
    });
}