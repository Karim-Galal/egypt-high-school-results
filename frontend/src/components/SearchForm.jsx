import { FaSearch } from "react-icons/fa";

import { useStudentSearch } from "../hooks/useStudentSearch";
import LoadingSpinner from "../components/LoadingSpinner"
import ErrorAlert from "../components/ErrorAlert"
import ResultCard from "../components/ResultCard"

export default function SearchForm() {

   

    const {
        query,
        loading,
        error,
        student,
        setQuery,
        handleSearch,
    } = useStudentSearch();

    return (

        <div className="rounded-2xl bg-white p-6 shadow-lg">
          <form onSubmit={handleSearch}>
            <label className="mb-3 block font-semibold">

                رقم الجلوس أو الاسم الرباعي

            </label>

            <input

                className="w-full rounded-xl border p-3 outline-none border-amber-400 focus:border-amber-600"

                placeholder="مثال: 2000000 أو أحمد محمود احمد"

                value={query}
                onChange={(e) => setQuery(e.target.value)}
            />

            <button
                type="submit"
                disabled={loading}

                className="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-amber-600 py-3 text-white transition hover:bg-amber-700"
                
                // onClick={handleSearch}
            >

                <FaSearch />

                بحث

            </button>

            <ErrorAlert message={error} />

            {loading && <LoadingSpinner />}
            

          </form>
              {student && <ResultCard student={student} />}
        </div>

    );
}