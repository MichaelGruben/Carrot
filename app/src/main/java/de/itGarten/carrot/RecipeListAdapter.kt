package de.itGarten.carrot

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.DiffUtil
import androidx.recyclerview.widget.ListAdapter
import androidx.recyclerview.widget.RecyclerView

class RecipeListAdapter : ListAdapter<Recipe, RecipeListAdapter.RecipeViewHolder>(RecipesComparator()) {

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): RecipeViewHolder {
        return RecipeViewHolder.create(parent)
    }

    override fun onBindViewHolder(holder: RecipeViewHolder, position: Int) {
        val current = getItem(position)
        holder.bind(current.title, current.timeLevel)
    }

    class RecipeViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        private val recipeItemView: TextView = itemView.findViewById(R.id.textView)
        private val recipeDurationView: TextView = itemView.findViewById(R.id.duration)
        private val durationNames = arrayOf(R.string.workTimeShort, R.string.workTimeMedium, R.string.workTimeLong)

        fun bind(text: String?, timeLevel: Int?) {
            recipeItemView.text = text
            recipeDurationView.text = itemView.context.getString(durationNames[timeLevel?.let{timeLevel} ?: run{2}])
        }

        companion object {
            fun create(parent: ViewGroup): RecipeViewHolder {
                val view: View = LayoutInflater.from(parent.context)
                    .inflate(R.layout.recyclerview_recipe, parent, false)
                return RecipeViewHolder(view)
            }
        }
    }

    class RecipesComparator : DiffUtil.ItemCallback<Recipe>() {
        override fun areItemsTheSame(oldItem: Recipe, newItem: Recipe): Boolean {
            return oldItem === newItem
        }

        override fun areContentsTheSame(oldItem: Recipe, newItem: Recipe): Boolean {
            return oldItem.title == newItem.title
        }
    }
}
