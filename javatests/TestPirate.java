package javatests;

import java.io.ByteArrayOutputStream;
import java.io.PrintStream;
import java.util.ArrayList;
import java.util.List;

public class TestPirate {
    // C'est ce qui permet de récupérer les sorties terminales
    private static final ByteArrayOutputStream outContent = new ByteArrayOutputStream();
    private static final ByteArrayOutputStream errContent = new ByteArrayOutputStream();
    private static final PrintStream originalOut = System.out;
    private static final PrintStream originalErr = System.err;

    public static List<String> getLine() {
        // StringBuilder pour récupérer la totalité de la ligne
        StringBuilder test = new StringBuilder();
        // Liste qui permet de stocker les différentes lignes
        List<String> listOutputs = new ArrayList<>();
        // On parcourt ce que l'utilisateur affiche
        for (char lettre : outContent.toString().toCharArray()) {
            // On ajoute la lettre si il n'y a aucun retour à la ligne
            if ((int) lettre != 13 && (int) lettre != 10) {
                test.append(lettre);
            } else { // Sinon on aoute la ligne à la liste et on efface le contenu du StringBuilder
                listOutputs.add(test.toString());
                test.setLength(0);
            }
        }
        listOutputs = corrigeListOutput(listOutputs);
        // On retourne la liste avec l'ensemble des lignes
        //System.out.println(listOutputs);
        return listOutputs;
    }

    public static List<String> corrigeListOutput(List<String> listOutput) {
        List<String> nouvelListOutput = new ArrayList<>();
        for (String mot : listOutput) {
            if (mot.length() > 0) {
                nouvelListOutput.add(mot);
            }
        }
        return nouvelListOutput;
    }
    public static void testLaClassePirateExiste() throws Exception {
        try {
            Class.forName("javatests.Pirate");
        } catch (Exception e) {
            throw new Exception("La classe doit être nommée : \"javatests.Pirate\".");
        }
    }

    public static void testLaMéthodeMainExisteCorrectement() throws Exception {
        try {
            Class.forName("javatests.Pirate").getMethod("main", String[].class);
        } catch (Exception e) {
            throw new Exception("La classe ne comporte pas de fonction main conforme. \n Attendu : public static void main(String[] args)");
        }
    }

    public static void main(String[] args) throws Exception {
        testLaClassePirateExiste();
        testLaMéthodeMainExisteCorrectement();

        System.setOut(new PrintStream(outContent));
        System.setErr(new PrintStream(errContent));
        Pirate.main(null);
        // Faire tests sur les constructeurs
        System.setErr(originalErr);
        System.setOut(originalOut);


        if (!errContent.toString().isEmpty()) {
            throw new Exception(errContent.toString());
        }
        
        // Tests attributs
        TestNomPirate.testsAttributNomPirate();
        TestTaillePirate.testsAttributTaillePirate();
        TestPointurePirate.testsAttributPointurePirate();
        TestLettrePirate.testsAttributLettrePirate();

        // Tests getter
        TestGetterNomPirate.testsMethodeGetNomPirate(getLine());
        TestGetterTaillePirate.testsMethodeGetTaillePirate(getLine());
        TestGetterPointurePirate.testsMethodeGetPointurePirate(getLine());
        TestGetterLettrePirate.testsMethodeGetLettrePirate(getLine());

        System.out.println("Exercice fini :)");
    }
}