<template>
  <div class="px-5">
    <div class="mx-auto max-w-2xl space-y-6 mt-12 bg-white p-12 rounded-lg">
      <div class="space-y-2 text-center">
        <h1 class="text-3xl font-bold">Lista</h1>
      </div>
      <div class="space-y-4">
        <div class="space-y-2">
          <div class="flex flex-col items-center justify-center bg-background">
            <div class="max-w-4xl w-full">
              <div class="border shadow-sm rounded-lg overflow-hidden">
                <div class="relative w-full overflow-auto">
                  <table class="w-full caption-bottom text-sm">
                    <tbody class="[&amp;_tr:last-child]:border-0">
                      <div
                        v-for="task in tasks"
                        :key="task.id"
                        class="px-5 flex flex-row items-center justify-center border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                      >
                        <input type="checkbox" @click="completedTask(task)" />
                        <p class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                          {{ task.todo }}
                        </p>

                        <div class="flex flex-row items-center justify-center ml-auto">
                          <router-link :to="'/edit/' + task.id">
                            <svg
                              class="h-5 w-5 text-slate-700"
                              viewBox="0 0 24 24"
                              stroke-width="2"
                              stroke="currentColor"
                              fill="none"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path stroke="none" d="M0 0h24v24H0z"></path>
                              <path
                                d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"
                              ></path>
                              <path
                                d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"
                              ></path>
                              <line x1="16" y1="5" x2="19" y2="8"></line>
                            </svg>
                          </router-link>

                          <button
                            class="ml-2 text-sm text-red-500 hover:text-red-600"
                            @click="deleteTask(task.id)"
                          >
                            <svg
                              class="h-5 w-5 text-amber-700"
                              width="24"
                              height="24"
                              viewBox="0 0 24 24"
                              stroke-width="2"
                              stroke="currentColor"
                              fill="none"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            >
                              <path stroke="none" d="M0 0h24v24H0z"></path>
                              <line x1="18" y1="6" x2="6" y2="18"></line>
                              <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                          </button>
                        </div>
                      </div>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      tasks: [],
    };
  },
  created() {
    this.getTasks();
  },

  methods: {
    getTasks() {
      axios
        .get("/tasks")
        .then((response) => (this.tasks = response.data))
        .catch((error) => {
          console.error(error);
        });
    },

    deleteTask($id) {
      console.log($id);
      axios
        .delete(`/tasks/${$id}`)
        .then((response) => console.log("Task deleted:", response.data))
        .catch((error) => {
          console.error(error);
        });
      this.getTasks();
    },

    completedTask(task) {
      task.completed = task.completed === 0 ? 1 : 0;

      axios
        .put(`/tasks/${task.id}`, { todo: task.todo, completed: task.completed }) 
        .then((response) => {
          console.log("Task updated:", response.data);
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
    },
  },
};
</script>
