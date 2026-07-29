import Header from "./components/Header";
import SearchForm from "./components/SearchForm";
import Footer from "./components/Footer";

function App() {
    return (
        <main className="min-h-screen bg-slate-100">

            <div className="mx-auto max-w-xl px-4 py-10">

                <Header />

                <SearchForm />

                <Footer />

            </div>

        </main>
    );
}

export default App;