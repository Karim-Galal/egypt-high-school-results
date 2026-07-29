import { FaGraduationCap } from "react-icons/fa";

export default function Header() {
    return (
        <header className="mb-10 text-center">

            <FaGraduationCap
                className="mx-auto mb-4 text-6xl text-amber-600"
            />

            <h1 className="text-4xl font-bold">

                نتيجة الثانوية العامة

            </h1>

            <p className="mt-2 text-slate-600">

                ابحث برقم الجلوس أو الاسم الرباعي

            </p>

        </header>
    );
}
