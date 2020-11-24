package de.itGarten.carrot

import android.app.Activity
import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.Observer
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.google.android.material.floatingactionbutton.FloatingActionButton

class MainActivity : AppCompatActivity() {
    private val newRecipeActivityRequestCode = 1
    private val recipeViewModel: RecipeViewModel by viewModels {
        RecipeViewModelFactory((application as RecipesApplication).repository)
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val recyclerView = findViewById<RecyclerView>(R.id.recyclerview)
        val adapter = RecipeListAdapter()
        recyclerView.adapter = adapter
        recyclerView.layoutManager = LinearLayoutManager(this)

        // Add an observer on the LiveData returned by getOrderedRecipes.
        // The onChanged() method fires when the observed data changes and the activity is
        // in the foreground.
        recipeViewModel.allRecipes.observe(this, Observer { recipes ->
            // Update the cached copy of the recipes in the adapter.
            recipes?.let { adapter.submitList(it) }
        })

        val fab = findViewById<FloatingActionButton>(R.id.fab)
        fab.setOnClickListener {
            val intent = Intent(this@MainActivity, NewRecipeActivity::class.java)
            startActivityForResult(intent, newRecipeActivityRequestCode)
        }

    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)

        if (requestCode == newRecipeActivityRequestCode && resultCode == Activity.RESULT_OK) {
            var title = "dummy"
            var duration = 2
            data?.getStringExtra(NewRecipeActivity.EXTRA_TITLE)?.let {
                title = it
            }
            data?.getIntExtra(NewRecipeActivity.EXTRA_DURATION, 2)?.let {
                duration = it
            }
            val recipe = Recipe(title, duration)
            recipeViewModel.insert(recipe)
        } else {
            Toast.makeText(
                applicationContext,
                R.string.empty_not_saved,
                Toast.LENGTH_LONG).show()
        }
    }

}