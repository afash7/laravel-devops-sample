# ===============================
# Stage 1: Build
# ===============================
FROM node:20-alpine AS builder

WORKDIR /app

# فقط فایل‌های dependency
COPY frontend/app/package*.json ./

RUN npm ci

# کپی سورس پروژه
COPY frontend/app .

# build production
RUN npm run build


# ===============================
# Stage 2: Production
# ===============================
FROM node:20-alpine

WORKDIR /app

ENV NODE_ENV=production

# فقط خروجی‌های لازم
COPY --from=builder /app/.next ./.next
COPY --from=builder /app/public ./public
COPY --from=builder /app/node_modules ./node_modules
COPY --from=builder /app/package.json ./package.json

EXPOSE 3000

CMD ["npm", "start"]
