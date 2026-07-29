export default function ErrorAlert({ message }) {
    if (!message) return null;

    return (
        <div className="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-center text-red-700">
            {message}
        </div>
    );
}