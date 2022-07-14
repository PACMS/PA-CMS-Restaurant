<?php

namespace App\Core;

use App\Core\MysqlBuilder;
use App\Model\Page as PageModel;

class CreatePage
{
    protected $comment_content;
    protected $page;

    public function createBasicPageIndex($fp, $inputs, $array_body, ?int $id = null)
    {
        if (is_null($id)) {
            $id = $_SESSION['favoriteRestaurant'];
        }
        $pageModel = new PageModel();
        $pages = $pageModel->getAllPagesFromRestaurant($id);
        
        $page = '<div class="topnav">';

        foreach ($pages as $pageDb) {
            $page .= '<li><a href="/' . $pageDb["url"] . '">' . $pageDb["title"] . '</a></li>';
        }

        $page .= '
        <li class="right"><a href="/login">Connexion</a></li>
        </div>
        <div class="index-header">
        <h1>' . $inputs['title'] . '</h1></div>';
        foreach ($array_body as $key => $body) {
            if (str_contains($key, "body")) {
                $page .= '<section class="page-container"><div>' . $body . '</div></section>';
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
                $page .= $this->getCommentsParent();
                $page .= "<section><form method=\"post\" action=\"/restaurant/addComment\" class=\"flex flex-column\" id=\"addComment\">
                <label for=\"content\">Ajouter un commentaire :</label>
                <textarea id=\"content\" name=\"content\" minlength=\"20\" maxlength=\"400\" required=\"required\"></textarea>
                <input type=\"hidden\" name=\"id_restaurant\" value=\"" . $_SESSION["restaurant"]["id"];
                $page .= "\"><input type=\"submit\" value=\"Publier\">
                </form></section>";
                $page .= "</section>";
            } else {
                $page .= '<section id="comments">
                <h1>Commentaires :</h1>
                <p>Aucun commentaires n\'a été publié !</p>';
                $page .= "<section><form method=\"post\" action=\"/restaurant/addComment\" class=\"flex flex-column\" id=\"addComment\">
                <label for=\"content\">Ajouter un commentaire :</label>
                <textarea id=\"content\" name=\"content\" minlength=\"20\" maxlength=\"400\" required=\"required\"></textarea>
                <input type=\"hidden\" name=\"id_restaurant\" value=\"" . $_SESSION["restaurant"]["id"];
                $page .= "\"><input type=\"submit\" value=\"Publier\">
                </form></section>
                </section>";
            }
        }
        
        // $page .= "</section>";
        fwrite($fp, $page);

    }

     function getCommentsParent()
     {
        $builder = new MysqlBuilder();
        $comments = $builder->select("comments", ["*"])
                            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                            ->where("id_parent", "0")
                            ->where("status", "1")
                            ->fetchClass("comment")
                            ->fetchAll();
        foreach ($comments as $comment) {
            $this->page .= "<section class=\"{$comment->getId()}\">";
            $user = $builder->select("user", ["*"])
                    ->where("id", $comment->getIdUser())
                    ->fetchClass("user")
                    ->fetch();
            $this->comment_content .= "<section>
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
                        <input type=\"hidden\" name=\"id_parent\" value=\"{$comment->getId()}\">
                        <input type=\"hidden\" name=\"id_restaurant\" value=\"" . $comment->getIdRestaurant();
                $this->comment_content .= "\"><input type=\"submit\" value=\"Répondre\">
                        </div>
                    </form>
                </footer>";
            $this->getChildren($comment->getId());
            $this->comment_content .= "</article></section>";
        }
        return $this->comment_content;
     }

     function getChildren($idParent)
     {
        $builder = new MysqlBuilder();
        $childrens = $builder->select("comments", ["*"])
                            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                            ->where("id_parent", $idParent)
                            ->where("status", "1")
                            ->fetchClass("comment")
                            ->fetchAll();
        foreach ($childrens as $children) {
            $user = $builder->select("user", ["*"])
                    ->where("id", $children->getIdUser())
                    ->fetchClass("user")
                    ->fetch();
            $this->comment_content .= "
            <article>
                <header>
                    <h3>{$user->getFirstname()} {$user->getLastname()}</h3>
                    <time>Publié le {$children->getCreatedAt()}</time>
                </header>
                <main>
                    <p>{$children->getContent()}</p>
                </main>
                <footer>
                    <button id=\"answerComment\">Répondre</button>
                    <form method=\"post\" action=\"/replyComment\" class=\"flex flex-column hidden\" id=\"replyComment\">
                        <label for=\"content\">Commentaire :</label>
                        <textarea id=\"content\" name=\"content\" minlength=\"20\" maxlength=\"400\" required=\"required\"";
                        $this->comment_content .= "></textarea>
                        <div>
                        <button id=\"cancel\">Annuler</button>
                        <input type=\"hidden\" name=\"id_parent\" value=\"{$children->getId()}\">
                        <input type=\"hidden\" name=\"id_restaurant\" value=\"" . $children->getIdRestaurant();
                $this->comment_content .= "\"><input type=\"submit\" value=\"Répondre\">
                        </div>
                    </form>
                </footer>";
            $this->getChildren($children->getId());
            $this->comment_content .= "</article>";
        }
     }
}
