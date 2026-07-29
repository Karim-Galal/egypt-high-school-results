export default function InfoRow({ label, value }) {
    return (
        <div className="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3">

            <span className="font-semibold text-slate-600">
                {label}
            </span>

            <span className="font-bold text-slate-900">
                {value}
            </span>

        </div>
    );
}