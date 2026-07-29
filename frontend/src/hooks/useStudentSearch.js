import { useReducer } from "react";
import api from "../services/api";
import normalizeDigits from "../utils/normalizeDigits";
import getErrorMessage from "../utils/getErrorMessage";

const initialState = {
    query: "",
    loading: false,
    error: "",
    student: null,
};

function reducer(state, action) {
    switch (action.type) {
        case "SET_QUERY":
            return {
                ...state,
                query: action.payload,
            };

        case "SEARCH_START":
            return {
                ...state,
                loading: true,
                error: "",
                student: null,
            };

        case "SEARCH_SUCCESS":
            return {
                ...state,
                loading: false,
                student: action.payload,
            };

        case "SEARCH_ERROR":
            return {
                ...state,
                loading: false,
                error: action.payload,
            };

        default:
            return state;
    }
}

export function useStudentSearch() {
    const [state, dispatch] = useReducer(reducer, initialState);

    function setQuery(value) {
        dispatch({
            type: "SET_QUERY",
            payload: value,
        });
    }

    async function handleSearch(e) {
        e.preventDefault();

        const input = normalizeDigits(state.query.trim());

        if (!input) {
            dispatch({
                type: "SEARCH_ERROR",
                payload: "يرجى إدخال رقم الجلوس أو الاسم الرباعي.",
            });

            return;
        }

        dispatch({
            type: "SEARCH_START",
        });

        try {
            const params = /^\d+$/.test(input)
                ? { seating_no: input }
                : { arabic_name: input };

            const response = await api.get("/students/search", {
                params,
            });

            dispatch({
                type: "SEARCH_SUCCESS",
                payload: response.data.data,
            });
        } catch (error) {
            dispatch({
                type: "SEARCH_ERROR",
                payload: getErrorMessage(error),
            });
        }
    }

    // return {
    //     state,
    //     setQuery,
    //     handleSearch,
    // };
    return {
        query: state.query,
        loading: state.loading,
        error: state.error,
        student: state.student,

        setQuery,
        handleSearch,
    };
}