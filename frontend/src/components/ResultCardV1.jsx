export default function ResultCard({ student }) {
    if (!student) return null;

    return (
        <div className="mt-6 rounded-2xl bg-white p-6 shadow-lg">

            <h2 className="mb-5 text-center text-2xl font-bold">
                نتيجة الطالب
            </h2>

            <div className="space-y-4">

                <InfoRow
                    label="الاسم"
                    value={student.arabic_name}
                />

                <InfoRow
                    label="رقم الجلوس"
                    value={student.seating_no}
                />

                <InfoRow
                    label="المجموع"
                    value={`${student.total_degree} / 320`}
                />

                <InfoRow
                    label="النسبة"
                    value={`${student.percentage}%`}
                />

                <InfoRow
                    label="الحالة"
                    value={student.student_case_desc}
                />

            </div>

        </div>
    );
}

function InfoRow({ label, value }) {
    return (
        <div className="flex items-center justify-between border-b pb-3">

            <span className="font-semibold">
                {label}
            </span>

            <span>
                {value}
            </span>

        </div>
    );
}