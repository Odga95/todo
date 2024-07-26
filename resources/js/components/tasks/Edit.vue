<template>
  <div class="px-5 w-full">
    <div class="mx-auto max-w-2xl space-y-2 mt-12 bg-white py-12 px-8 rounded-lg">
      <div class="text-left flex justify-left gap-6 items-center">
        <h1 class="text-base font-bold">Editar Tarea {{ id }}</h1>

      </div>
      <div class="space-y-4">
        <form
          method="POST"
          @submit.prevent="saveTask"
          v-if="isDivVisible"
          class="flex justify-between gap-6 items-center"
        >
          <input
            class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
            type="text"
            id="text"
            placeholder="Nueva tarea"
            required
            v-model="task.todo"
          />
          <button
            class="inline-flex items-center bg-slate-500 text-white w-fit hover:bg-gray-300 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full"
            type="submit"
          >
            Editar 
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      id: this.$route.params.id,
      task: '', // Inicializar como cadena vacía
      isDivVisible: true,
    };
  },
    created() {
      axios
        .get(`/tasks/${this.id}/edit`)
        .then((response) => {
          this.task = response.data;
        })
        .catch((error) => {
          console.error("Error fetching task:", error);
        });
    },
  methods: {

    saveTask() {
      axios
        .put(`/tasks/+${this.id}`, { todo: this.task.todo , completed: '0'})
        .then((response) => {
          console.log("Task saved:", response.data);
        })
        .catch((error) => {
          if (error.response) {
            console.error("Error response:", error.response.data);
          } else if (error.request) {
            console.error("No response received:", error.request);
          } else {
            console.error("Error message:", error.message);
          }
        });
        this.$router.push(`/tasks`);
    },
    toggleDivVisibility() {
      this.isDivVisible = !this.isDivVisible;
    },
  },
};
</script>
