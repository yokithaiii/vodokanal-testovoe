<script setup>
  import ChartComponent from './components/Chart.vue';
  import StudentsTable from './components/StudentsTable.vue';
  import StudentsBlock from './components/StudentsBlock.vue';
  import TeachersTable from './components/TeachersTable.vue';
  import TeachersBlock from './components/TeachersBlock.vue';
  import CoursesTable from './components/CoursesTable.vue';

  import { ref } from 'vue';

  const currentView = ref('table');
  const currentTable = ref('teachers');

  const toggleView = () => {
    currentView.value = currentView.value === 'table' ? 'chart' : 'table';
  };

  const toggleTable = (table) => {
    currentTable.value = table;
  };
</script>

<template>
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-3">
        <TeachersBlock/>
      </div>
      <div class="col-3">
        <StudentsBlock/>
      </div>
      <div class="col-6">
        <div class="card text-white">
          <div class="card-body">
            <div class="row mb-2">
              <div class="col d-flex justify-content-center gap-2">
                <h5 :class="{ 'active': currentTable === 'teachers' }" @click="toggleTable('teachers')">Учителя</h5>
                <span> / </span>
                <h5 :class="{ 'active': currentTable === 'students' }" @click="toggleTable('students')">Студенты</h5>
              </div>
            </div>
            <TeachersTable v-if="currentTable === 'teachers'"/>
            <StudentsTable v-else-if="currentTable === 'students'"/>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card text-white">
          <div class="card-body">
            <div class="row mb-2">
              <div class="d-flex justify-content-between">
                <span></span>
                <h5>Курсы</h5>
                <a href="#" @click="toggleView()">Изменить вид</a>
              </div>
            </div>
            <CoursesTable v-if="currentView === 'table'"/>
            <ChartComponent v-if="currentView === 'chart'"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


