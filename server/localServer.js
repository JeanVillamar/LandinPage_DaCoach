import "dotenv/config";
import express from "express";
import cors from "cors";
import { getChatReply } from "./chatService.js";
import { validateMessages } from "./validateMessages.js";

const app = express();
app.use(cors());
app.use(express.json());

app.post("/api/chat", async (req, res) => {
  const { messages } = req.body ?? {};

  const validationError = validateMessages(messages);
  if (validationError) {
    res.status(400).json({ error: validationError });
    return;
  }

  try {
    const reply = await getChatReply(messages);
    res.json({ reply });
  } catch (error) {
    console.error("Error al llamar a Groq:", error);
    res.status(502).json({ error: "No se pudo obtener respuesta del asistente. Intenta de nuevo." });
  }
});

const port = process.env.PORT ?? 8787;
app.listen(port, () => {
  console.log(`Servidor de chat local escuchando en http://localhost:${port}`);
});
