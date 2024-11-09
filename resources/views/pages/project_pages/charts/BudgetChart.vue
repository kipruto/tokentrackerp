<template>
    <div>
      <canvas ref="budgetChart"></canvas>
    </div>
  </template>

  <script>
  import { onMounted, ref } from 'vue';
  import { Chart, BarElement, CategoryScale, LinearScale } from 'chart.js';

  Chart.register(BarElement, CategoryScale, LinearScale);

  export default {
    props: {
      allocated: Number,
      current: Number,
    },
    setup(props) {
      const budgetChart = ref(null);

      onMounted(() => {
        new Chart(budgetChart.value, {
          type: 'bar',
          data: {
            labels: ['Allocated Budget', 'Current Budget'],
            datasets: [
              {
                label: 'Budget in USD',
                data: [props.allocated, props.current],
                backgroundColor: ['#4CAF50', '#FF9800'],
              },
            ],
          },
          options: {
            indexAxis: 'y',
            plugins: {
              legend: { display: false },
            },
          },
        });
      });

      return { budgetChart };
    },
  };
  </script>

  <style scoped>
  canvas {
    max-width: 100%;
  }
  </style>
