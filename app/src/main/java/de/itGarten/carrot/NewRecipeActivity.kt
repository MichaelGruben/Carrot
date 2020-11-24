package de.itGarten.carrot

import android.app.Activity
import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.text.TextUtils
import android.widget.Button
import android.widget.EditText
import android.widget.SeekBar

class NewRecipeActivity : AppCompatActivity() {

    private lateinit var editRecipeTitle: EditText
    private lateinit var editRecipeDuration: SeekBar

    public override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_new_recipe)
        editRecipeTitle = findViewById(R.id.edit_recipe)
        editRecipeDuration = findViewById(R.id.workDuration)

        val button = findViewById<Button>(R.id.button_save)
        button.setOnClickListener {
            val replyIntent = Intent()
            if (TextUtils.isEmpty(editRecipeTitle.text)) {
                setResult(Activity.RESULT_CANCELED, replyIntent)
            } else {
                val title = editRecipeTitle.text.toString()
                val duration = editRecipeDuration.progress
                replyIntent.putExtra(EXTRA_TITLE, title)
                replyIntent.putExtra(EXTRA_DURATION, duration)
                setResult(Activity.RESULT_OK, replyIntent)
            }
            finish()
        }
    }

    companion object {
        const val EXTRA_TITLE = "de.itGarten.carrot.recipelistsql.TITLE"
        const val EXTRA_DURATION = "de.itGarten.carrot.recipelistsql.DURATION"
    }
}
