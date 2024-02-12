<template>
  <div class="card text-white">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h5>Студенты</h5>
        <a href="#" @click="toggleView()">Изменить вид</a>
      </div>
      <div v-show="currentView === 'pie'">
        <canvas id="myChartStudents" width="400" height="400"></canvas>
      </div>
      <div v-show="currentView === 'block'">
        <div class="card-list text-start">
          <div class="count fs-1">
            {{ teachersCount }}
          </div>
          <div class="description">
            Всего
          </div>
        </div>
        <div class="card-list text-start">
          <div class="count fs-1">
            {{ teachersWithCoursesCount }}
          </div>
          <div class="description">
            С курсами
          </div>
        </div>
        <div class="card-list text-start">
          <div class="count fs-1">
            {{ teachersWithoutCoursesCount }}
          </div>
          <div class="description">
            Без курсов
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import Chart from 'chart.js/auto';

  const teachersCount = ref(0);
  const teachersWithCoursesCount = ref(0);
  const teachersWithoutCoursesCount = ref(0);
  const currentView = ref('block');

  const toggleView = () => {
    currentView.value = currentView.value === 'block' ? 'pie' : 'block';
  };

  onMounted(async () => {
    try {
      const response = await axios.get('http://backend.vue-laravel-app.local/api/students');
      const teachers = response.data.data;

      teachersCount.value = teachers.length;
      teachersWithCoursesCount.value = teachers.filter(teacher => teacher.course_id).length;
      teachersWithoutCoursesCount.value = teachers.filter(teacher => !teacher.course_id).length;

        const data = {
          labels: ['С курсами', 'Без курсов'],
          datasets: [{
            label: 'Всего',
            data: [teachersWithCoursesCount.value, teachersWithoutCoursesCount.value],
            backgroundColor: [
              '#5E88FC',
              '#FF9F4D',
              '#6DD7B9'
            ],
          }]
        };
  
        const config = {
          type: 'pie',
          data: data,
          options: {
            responsive: true,
            plugins: {
              title: {
                display: true,
                text: 'Количество учителей и их курсы'
              }
            }
          },
        };
  
        const myChartStudents = new Chart(
          document.getElementById('myChartStudents'),
          config
        );
      

    } catch (error) {
      console.error('Ошибка при получении данных:', error);
    }
  });

</script>
