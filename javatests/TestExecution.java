package javatests;

import java.util.concurrent.*;

public class TestExecution {

    public static void main(String[] args) throws TimeoutException {
        ExecutorService executor = Executors.newSingleThreadExecutor();

        Callable<Void> task = new Callable<Void>() {
            @Override
            public Void call() throws Exception {
                contenuExercice(args[0]);
                return null;
            }
        };

        Future<Void> future = executor.submit(task);
        try {
            // Limite le temps d'exécution à 5 secondes
            future.get(5, TimeUnit.SECONDS);
        } catch (TimeoutException e) {
            System.out.println("Temps d'exécution dépassé, arrêt de la méthode.");
            future.cancel(true);
            System.exit(1);
        } catch (Exception e) {
            System.out.println("Erreur lors de l'exécution de la méthode : " + e.getMessage());
            future.cancel(true);
            System.exit(1);
        } finally {
            executor.shutdownNow();
        }
    }

    public static void contenuExercice(String className) throws Exception {
        String[] mainArgs = {"arg1", "arg2", "arg3"}; // les arguments de la ligne de commande
        Class.forName("javatests." + className).getDeclaredMethod("main", String[].class).invoke(null, (Object) mainArgs);
    }
}