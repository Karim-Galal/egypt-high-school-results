export default function LoadingSpinner() {
    return (
        <div className="mt-6 flex justify-center">
            <div className="h-8 w-8 animate-spin rounded-full border-4 border-slate-300 border-t-amber-600"></div>
        </div>
    );
}