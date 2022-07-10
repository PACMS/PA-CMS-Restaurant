<?php

namespace App\Core;

use App\Core\MysqlBuilder;
use App\Model\Comment;

class CreatePage
{
    protected $comment_content;
    protected $page;

    public function createBasicPageIndex($fp, $inputs, $array_body)
    {
        $page = '
        <div class="index-header">
        <h1 >' . $inputs['title'] . '<h1></div>';

        foreach ($array_body as $key => $body) {
            if (str_contains($key, "body")) {
                $page .= '<section class="page-container"><img src="data:image/jpeg;base64,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" alt="balka"/><div><p>' . $body . '</p></div></section>';
            }
        }

        // On vérifie que l'utilisateur veut afficher les cartes
        if ($array_body["displayMenu"] == 1) {
            $builder = new MysqlBuilder();
            // On récupére toutes les cartes selon des paramétres
            $carte = $builder->select("carte", ["*"])
                            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                            ->where("status", "1")
                            ->fetchClass("carte")
                            ->fetch();
            // On Vérifie qu'il existe bien des cartes
            if (!empty($carte)) {
                $categories = $builder->select("categorie", ["*"])
                                    ->where("id_carte", $carte->getId())
                                    ->fetchClass("categorie")
                                    ->fetchAll();
                $meals = $builder->select("meal", ["*"])
                                    ->where("id_carte", $carte->getId())
                                    ->fetchClass("meal")
                                    ->fetchAll();
            }


            // on va créer toute l'architecture du code pour afficher les cartes
            $page .= 
            "<section id=\"carte\">
                <h3>Notre Carte :</h3>
                <h1>";
                if (!empty($carte)) {
                    $page .= $carte->getName();
                } else {
                   $page .= "Pas de carte active !";
                } 
                $page .= "</h1>
                <section id=\"categories\">";
                    if (!empty($categories)) {
                        foreach ($categories as $categorie) {
                            $page .=
                            "<article>
                                <h1>{$categorie->getName()}</h1>";
                            if (!empty($meals)) {
                                $page .= "<ul>";
                                    foreach($meals as $meal) {
                                        if ($meal->getIdCategorie() == $categorie->getId()) {
                                            $mealsFoods = $builder->select("mealsFoods", ["*"])
                                                ->where("meal_id", $meal->getId())
                                                ->fetchClass("mealsFoods")
                                                ->fetchAll();
                                           
                                            $page .= "<li>
                                                <h3>{$meal->getName()} <span>{$meal->getPrice()} &euro;</span></h3>";
                                                if (!empty($mealsFoods)) {
                                                    $foodArray = [];
                                                    foreach ($mealsFoods as $mealsFood) {
                                                        $foods = $builder->select("food", ["*"])
                                                            ->where("id", $mealsFood->getFoodId())
                                                            ->fetchClass("food")
                                                            ->fetchAll();
                                                        foreach ($foods as $food) {
                                                            array_push($foodArray, $food->getName());
                                                        }
                                                    }
                                                    $page .= "<p>" . implode(", ", $foodArray) ."</p>";
                                                } else {
                                                    $page .= "<p>Aucun ingrédients renseigné</p>";
                                                }
                                                $page .= "<p>". empty($meal->getDescription()) != 0 ? $meal->getDescription() : "Pas de description renseigné" . "</p>";
                                            $page .= "</li>";
                                        }
                                    }
                                $page .= "</ul>";
                            } else {
                                $page .= "<p>Aucun plats n'a été renseigné !</p>";
                            }
                            $page .="</article>";
                        } 
                    } else {
                        $page .= "<p>Aucune catégorie n'a été renseigné !</p>";
                    }
                    $page .= "</section></section>";
    }
        if ($array_body["displayComment"] == 1) {
            $builder = new MysqlBuilder();
            $comments = $builder->select("comments", ["*"])
                            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                            ->where("status", "1")
                            ->fetchClass("comment")
                            ->fetchAll();
            if (!empty($comments)) {
                $page .= '<section id="comments">
                    <h1>Avis</h1>';
                $page .= $this->getCommentForParent();
                $page .= "</section>";
            } else {
                $page .= '<section id="comments">
                <h1>Commentaires :</h1>
                <p>Aucun commentaires n\'a été publié !</p>
                </section>';
            }
        }


        $page .= "</section>";
        fwrite($fp, $page);
    }

    function getCommentForParent($parent=0) 
    {
        $builder = new MysqlBuilder();
        $commentModel = new Comment();
        $comments = $builder->select("comments", ["*"])
                            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                            ->where("id_parent", $parent)
                            ->where("status", "1")
                            ->fetchClass("comment")
                            ->fetchAll();
        
        foreach($comments as $comment) {
            $user = $builder->select("user", ["*"])
                        ->where("id", $comment->getIdUser())
                        ->fetchClass("user")
                        ->fetch();
                $this->comment_content .= "
                <article>
                    <header>
                        <h3>{$user->getFirstname()} {$user->getLastname()}</h3>
                        <time>Publié le {$comment->getCreatedAt()}</time>
                    </header>
                    <main>
                        <p>{$comment->getContent()}</p>
                    </main>
                    <footer>
                        <button id=\"answerComment\">Répondre</button>
                        <form method=\"post\" action=\"/replyComment\" class=\"flex flex-column hidden\" id=\"replyComment\">
                            <label for=\"content\">Commentaire :</label>
                            <textarea id=\"content\" name=\"content\" minlength=\"20\" maxlength=\"400\" required=\"required\"";
                            $this->comment_content .= "></textarea>
                            <div>
                            <button id=\"cancel\">Annuler</button>
                            <input type=\"hidden\" name=\"id_restaurant\" value=\"" . $comment->getIdRestaurant();
                    $this->comment_content .= "\"><input type=\"submit\" value=\"Répondre\">
                    </div>
                    </form>
                    </footer>";
                    $this->getCommentForParent($comment->getId());
                    if (!empty($this->comment_content)) {
                        $this->comment_content .= "</article>";
                        $this->page .= "<section class=\"{$comment->getId()}\">{$this->comment_content}</section>";
                        $this->comment_content = "";
                    }
        }   
        return $this->page;
     }
}
