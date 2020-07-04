<template>
	<div class="text-center">
      <v-btn
        dark
        color="orange darken-2"
      >
        Open Snackbar
      </v-btn>

      <v-snackbar
        :v-model="true"
        timeout="5"
      >
        <!-- {{ text }} -->

      </v-snackbar>
    </div>
</template>

<script>
export default {
	// props : {
	// 	alert : Boolean,
	// 	type: String,
	// 	message : String
	// }
}
</script>