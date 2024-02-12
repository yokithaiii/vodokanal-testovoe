<template>
  <div style="width: 800px; height: 800px; margin: 0 auto;">
    <canvas id="myChart" width="400" height="400"></canvas>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import Chart from 'chart.js/auto';
import axios from 'axios';

const students = ref([]);

const fetchData = async () => {
  try {
    const response = await axios.get('http://backend.vue-laravel-app.local/api/courses');
    students.value = response.data.data.slice(0, 10);
    const studentCounts = students.value.map(course => course.students.count);

    const data = {
      labels: students.value.map(course => course.name),
      datasets: [{
        label: 'Студентов',
        data: studentCounts,
        backgroundColor: [
          '#5E88FC',
          '#FF9F4D',
          '#6DD7B9',
          '#FF6384',
          '#4BC0C0',
          '#A085FF',
          '#B4EBE0',
          '#FF5A5E',
          '#98B8E2',
          '#FF80ED',
        ],
      }]
    };

    const config = {
      type: 'pie',
      data: data,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Кол-во студентов на каждом курсе'
          }
        }
      },
    };

    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
};

onMounted(() => {
  fetchData();
});

</script>