<template>
  <table class="table table-borderless table-dark table-striped">
    <thead>
      <tr>
        <th scope="col" @click="sortBy('id')">
          ID
          <span v-if="sortKey === 'id'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
        </th>
        <th scope="col" @click="sortBy('name')">
          Имя
          <span v-if="sortKey === 'name'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
        </th>
        <th scope="col" @click="sortBy('lastname')">
          Фамилия
          <span v-if="sortKey === 'lastname'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
        </th>
        <th scope="col" @click="sortBy('age')">
          Возраст
          <span v-if="sortKey === 'age'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
        </th>
        <th scope="col" @click="sortBy('email')">
          Email
          <span v-if="sortKey === 'email'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
        </th>
        <th scope="col" @click="sortBy('phone')">
          Номер телефона
          <span v-if="sortKey === 'phone'">{{ sortDirection === 'asc' ? '▲' : '▼' }}</span>
        </th>  
      </tr>
    </thead>
    <tbody>
      <tr v-for="student in sortedStudents" :key="student.id">
        <th scope="row">{{ student.id }}</th>
        <td>{{ student.name }}</td>
        <td>{{ student.lastname }}</td>
        <td>{{ student.age }}</td>
        <td>{{ student.email }}</td>
        <td>{{ student.phone }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script setup>
  import { ref, onMounted, computed } from 'vue';
  import axios from 'axios';

  const students = ref([]);
  const sortKey = ref('id');
  const sortDirection = ref('asc');

  onMounted(() => {
    axios.get('http://backend.vue-laravel-app.local/api/students')
      .then(response => {
        students.value = response.data.data;
        // console.log(students.value);
      })
      .catch(error => {
        console.error('Ошибка при получении данных:', error);
      });
  });

  const sortedStudents = computed(() => {
    if (!sortKey.value) {
      return students.value.slice(0, 10);
    }

    return students.value.slice(0, 10).sort((a, b) => {
      const modifier = sortDirection.value === 'asc' ? 1 : -1;

      if (a[sortKey.value] < b[sortKey.value]) return -1 * modifier;
      if (a[sortKey.value] > b[sortKey.value]) return 1 * modifier;
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