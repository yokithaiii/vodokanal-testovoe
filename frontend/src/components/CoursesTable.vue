<template>
  <div>
    <div class="d-flex justify-content-center">
      <div class="col-4">
        <div class="input-group mb-3">
          <input type="text" v-model="filter" class="form-control" placeholder="Введите любое слово">
        </div>
      </div>
    </div>
    <table class="table table-borderless table-dark table-striped">
      <thead>
        <tr>
          <th scope="col" @click="sortBy('id')">
            ID
            <span v-if="sortKey === 'id'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
          </th>
          <th scope="col" @click="sortBy('name')">
            Название курса
            <span v-if="sortKey === 'name'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
          </th>
          <th scope="col" @click="sortBy('material.title')">
            Название материала
            <span v-if="sortKey === 'material.title'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
          </th>
          <th scope="col" @click="sortBy('teacher.name')">
            Преподаватель курса
            <span v-if="sortKey === 'teacher.name'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
          </th>
          <th scope="col" @click="sortBy('students.count')">
            Студенты
            <span v-if="sortKey === 'students.count'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
          </th> 
        </tr>
      </thead>
      <tbody>
        <tr v-for="course in filteredCourses" :key="course.id">
          <td>{{ course.id }}</td>
          <td>{{ course.name }}</td>
          <td>{{ course.material.title }}</td>
          <td>{{ course.teacher.name }} {{ course.teacher.lastname }}</td>
          <td>
            <tr v-for="student in course.students.items" :key="student.id">
              {{ student.name }} {{ student.lastname }}
            </tr>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const courses = ref([]);
const sortKey = ref('id');
const sortDirection = ref('asc');
const filter = ref('');

onMounted(async () => {
  try {
    const response = await axios.get('http://backend.vue-laravel-app.local/api/courses');
    courses.value = response.data.data;
  } catch (error) {
    console.error('Ошибка при получении данных:', error);
  }
});

const filteredCourses = computed(() => {

  const filtered = courses.value.slice(0, 10).filter(course => {
    const name = course.name.toLowerCase();
    const material = course.material.title.toLowerCase();
    const teacher = `${course.teacher.name.toLowerCase()} ${course.teacher.lastname.toLowerCase()}`;
    const searchTerm = filter.value.toLowerCase();

    return name.includes(searchTerm) || material.includes(searchTerm) || teacher.includes(searchTerm) || course.students.items.some(student => {
      const studentName = `${student.name.toLowerCase()} ${student.lastname.toLowerCase()}`;
      return studentName.includes(searchTerm);
    });
  });

  return filtered.slice(0, 10).sort((a, b) => {
    const modifier = sortDirection.value === 'asc' ? 1 : -1;
    const valueA = sortKey.value.includes('.') ? a[sortKey.value.split('.')[0]][sortKey.value.split('.')[1]] : a[sortKey.value];
    const valueB = sortKey.value.includes('.') ? b[sortKey.value.split('.')[0]][sortKey.value.split('.')[1]] : b[sortKey.value];
    if (valueA < valueB) return -1 * modifier;
    if (valueA > valueB) return 1 * modifier;
    return 0;
  });
  
});

const sortBy = (key) => {
  if (sortKey.value === key) {
    sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
  } else {
    sortKey.value = key;
    sortDirection.value = 'asc';
  }
};

</script>