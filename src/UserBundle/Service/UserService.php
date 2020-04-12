<?php

namespace UserBundle\Service;

use Doctrine\ORM\EntityManager as EM;

/**
 * Description of UserService
 *
 * @author frup73532
 */
class UserService {

    private $entityManager;   

    public function __construct(EM $em) {
        $this->entityManager = $em;
    }

    public function getAllUsers() {
        return $this->entityManager->getRepository('UserBundle:User')->findAllUsers();
    }

    public function getAllUsersByFiltre($nomClient, $idAdmin) {
        return $this->entityManager->getRepository('UserBundle:User')->findAllUsersByFiltre($nomClient, $idAdmin);
    }

    public function getAllMoniteurs($idEntreprise) {
        return $this->entityManager->getRepository('UserBundle:User')->findAllMoniteurs($idEntreprise);
    }

    public function getAllUsersMoniteur($idMoniteur) {
        return $this->entityManager->getRepository('UserBundle:User')->findUsersByMoniteur($idMoniteur);
    }

    public function getUser($id) {
        return $this->entityManager->getRepository('UserBundle:User')->findOneById($id);
    }

    public function getUserByName($nom) {
        return $this->entityManager->getRepository('UserBundle:User')->findOneByNom($nom);
    }

    public function deleteUser($id) {
        $user = $this->entityManager->getRepository('UserBundle:User')->findOneById($id);
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function getReservationsByClient($idUser) {
        return $this->entityManager->getRepository('UserBundle:User')->findReservations($idUser);
    }

    public function switchMoniteur($user, $moniteur) {
        $user->setMoniteur($moniteur);
        $this->entityManager->flush();
    }

    public function addArgent($nom, $sommeArgent) {
        $user = $this->getUserByName($nom);
        $prixResa=$user->getEntreprise()->getPrixResa();
        $money = $user->getMoney();
        if ($money >= 0) {
            $moneyUpdate = $money + $sommeArgent;
            $nbJeton = intdiv($moneyUpdate, $prixResa);
            $resteArgent = $moneyUpdate % $prixResa;
            $user->setSolde($user->getSolde() + $nbJeton);
            $user->setMoney($resteArgent);
        } else {
            $moneyUpdate = $money + $sommeArgent;
            // Il rembourse se qu'il devait
            if ($moneyUpdate <= 0) {
                $user->setMoney($moneyUpdate);
            } else {
                // Il rembourse et il achète des jetons				
                $nbJeton = intdiv($moneyUpdate, $prixResa);
                $resteArgent = $moneyUpdate % $prixResa;
                $user->setSolde($user->getSolde() + $nbJeton);
                $user->setMoney($resteArgent);
            }
        }
        $this->entityManager->flush();
        return $user;
    }

    public function removeUnArgent($nom) {
        $user = $this->getUserByName($nom);
        $user->setSolde($user->getSolde() - 1);
        $this->entityManager->flush();
        return $user;
    }

    public function addUnArgent($nom) {
        $user = $this->getUserByName($nom);
        $user->setSolde($user->getSolde() + 1);
        $this->entityManager->flush();
        return $user;
    }

    public function removeArgent($nom, $sommeArgent) {
        $prixResa=$user->getEntreprise()->getPrixResa();
        $nbJeton = intdiv($sommeArgent, $prixResa);
        $user = $this->getUserByName($nom);
        $user->setSolde($user->getSolde() + $nbJeton);
        $user->setMoney($user->getMoney() - $sommeArgent);
        $this->entityManager->flush();
        return $user;
    }

    public function affecteDefault($user) {
        // Grande Delle : id Admin =15
        if ($user->getEntreprise() == "Auto-Ecole Grande Delle") {
            $moniteur = $this->getUser(15);
            $entreprise = $moniteur->getEntreprise();
            // Mark coiffure : id Admin =24
        } else if ($user->getEntreprise() == "Marco Coiffure") {
            $moniteur = $this->getUser(24);
            $entreprise = $moniteur->getEntreprise();
        }
        $user->setMoniteur($moniteur);
        $user->setAdministrateur($moniteur);
        $user->setEntreprise($entreprise);
        $this->entityManager->flush();
    }

    public function affecteMoniteur($user, $idMoniteur) {
        $moniteur = $this->getUser($idMoniteur);
        $user->setMoniteur($moniteur);
        $this->entityManager->flush();
    }

    // Retourne toutes les réservations du moniteur de idClient
    public function getAllReservationsFromClient($idClient) {
        $clients = $this->getAllUsersMoniteur($this->getUser($idClient)->getMoniteur()->getId());
        $reservations = array();
        foreach ($clients as $client) {
            $lesResas = $this->getReservationsByClient($client['id']);
            foreach ($lesResas as $resa) {
                array_push($reservations, $resa);
            }
        }
        return $reservations;
    }

    // Retourne toutes les réservations d'un moniteur
    public function getAllReservationsFromMoniteur($idMoniteur) {
        $clients = $this->getAllUsersMoniteur($idMoniteur);
        $reservations = array();
        foreach ($clients as $client) {
            $lesResas = $this->getReservationsByClient($client['id']);
            foreach ($lesResas as $resa) {
                array_push($reservations, $resa);
            }
        }
        return $reservations;
    }

    public function getEM() {
        return $this->entityManager;
    }

    // Retourne un user DTO
    public function getUserDTO($client) {
        $userDTO = $client['nom'];
        //$userDTO=array("id"=>$client['id'],"nom"=>$client['nom'],"prenom"=>$client['prenom']);
        //$userDTO = new UserDTO($client['id'],$client['nom'],$client['prenom']);
        return $userDTO;
    }

}
