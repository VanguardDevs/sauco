import React, { useState, useRef, useEffect } from 'react';
import PropTypes from 'prop-types';
import Chartjs from 'chart.js';

const Chart = ({ config }) => {
  const chartContainer = useRef(null);
  const [chartInstance, setChartInstance] = useState(null);

  useEffect(() => {
    if (chartContainer && chartContainer.current) {
      const newChartInstance = new Chartjs(chartContainer.current, config);
      setChartInstance(newChartInstance);
    }
  }, [chartContainer]);

  return (
    <div>
      <canvas ref={chartContainer} />
    </div>
  );
};

Chart.propTypes = {
  config: PropTypes.object.isRequired
};

export default Chart;
