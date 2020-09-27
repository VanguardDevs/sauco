import React, { useState, useEffect } from 'react';
import axios from 'axios';

const useFetch = (url, options) => {
  const [response, setResponse] = useState(null);
  const [error, setError] = useState(null);
  const [isLoading, setIsLoading] = useState(true);
 
  useEffect(() => {
    axios.get(url)
      .then(res => {
        setResponse(res.data);
        setIsLoading(false);
      })
      .catch(err => setError(err.response.data));
  }, []);

  return { response, error, isLoading };
}

export default useFetch;
