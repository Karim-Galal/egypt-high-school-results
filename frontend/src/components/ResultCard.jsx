import InfoRow from "./InfoRow";

export default function ResultCard({ student }) {
    if (!student) return null;

    const status = student.student_case_desc;

    let dotColor = "bg-green-500";

    if (status.includes("ثان")) {
        dotColor = "bg-red-500";
    } else if (status.includes("راسب")) {
        dotColor = "bg-red-500";
    }

    return (
        <div className="mt-6 rounded-3xl border border-amber-100 bg-white p-6 shadow-xl">

            {/* Student Name */}
            <h2 className="mb-6 text-center text-2xl font-extrabold leading-relaxed text-slate-800">
                {student.arabic_name}
            </h2>

            {/* Main Stats */}
            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">

                {/* Percentage */}
                <div className="rounded-2xl border border-amber-200 bg-amber-50 p-6 text-center">

                    <p className="text-sm font-bold tracking-wide text-amber-700">
                        النسبة المئوية
                    </p>

                    <p className="mt-3 break-words text-4xl font-black text-slate-900 sm:text-5xl">
                        {student.percentage}%
                    </p>

                </div>

                {/* Total */}
                <div className="rounded-2xl border border-amber-200 bg-amber-50 p-6 text-center">

                    <p className="text-sm font-bold tracking-wide text-amber-700">
                        المجموع الكلي
                    </p>

                    <p className="mt-3 break-words text-4xl font-black text-slate-900 sm:text-5xl">
                        {student.total_degree}
                    </p>

                    <p className="mt-1 text-lg font-semibold text-slate-500">
                        من 320
                    </p>

                </div>

            </div>

            {/* Status */}
            <div className="my-8 flex justify-center">

                <span className="inline-flex items-center gap-3 rounded-full border border-slate-200 bg-slate-50 px-5 py-2 text-base font-bold text-slate-700">

                    <span className={`h-3.5 w-3.5 rounded-full ${dotColor}`}></span>

                    {status}

                </span>

            </div>

            {/* Extra Information */}
            <div className="space-y-3">

                <InfoRow
                    label="المجموع"
                    value={`${student.total_degree} / 320`}
                />

                <InfoRow
                    label="النسبة"
                    value={`${student.percentage}%`}
                />

            </div>

        </div>
    );
}