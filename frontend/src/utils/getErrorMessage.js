export default function getErrorMessage(error) {
    if (!error.response) {
        return "تعذر الاتصال بالخادم. يرجى المحاولة مرة أخرى.";
    }

    switch (error.response.status) {
        case 404:
            return "لم يتم العثور على الطالب.";

        case 422:
            return "يرجى إدخال الاسم الرباعي أو رقم الجلوس بشكل صحيح.";

        case 500:
            return "حدث خطأ في الخادم.";

        default:
            return "حدث خطأ غير متوقع.";
    }
}


